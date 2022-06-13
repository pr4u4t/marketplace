<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';


    public static function allActiveIds(){
        if(config('app.cache')){
            return Cache::remember('category:active',600,function() {
                $ret = array();
                $categories = Category::whereNull('parent_id')->where('active',true);
                
                foreach($categories as $category){
                    if($category->active){
                        array_merge($ret,$category->allChildrenIds());
                    }
                }
                
                return $ret;
            });
        }
        
        $ret = array();
        $categories = Category::whereNull('parent_id')->where('active',true);
        
        foreach($categories as $category){
            if($category->active){
                array_merge($ret,$category->allChildrenIds());
            }
        }
        
        return $ret;
    }
    
    /**
     * Returns collection of root categories
     *
     * @return \Illuminate\Support\Collection
     */
    public static function roots($ordby = 'name', $order = 'asc'){
        $ret = config('app.cache') ? Cache::remember('category:roots:'.$ordby.':'.$order,600,function() use($ordby,$order){
            return Category::whereNull('parent_id')->where('active',true)->orderBy($ordby,$order)->get();
        }) : self::whereNull('parent_id')->where('active',true)->orderBy($ordby,$order)->get();
        
        return $ret;
    }

    public static function adminRoots(){
        $ret = config('app.cache') ? Cache::remember('category:adminRoots',600,function() {
            return category::whereNull('parent_id')->get();
        }) : self::whereNull('parent_id')->get();
        
        return $ret;
    }
    
    /**
     * Returns the collection of all categories A-Z ordered
     *
     * @return \Illuminate\Support\Collection
     */
    public static function nameOrdered(){
        $ret = config('app.cache') ? Cache::remember('category:adminNameOrdered',600,function(){
            return Category::where('active',true)->orderBy('name')->get();
        }) : self::where('active',true)->orderBy('name')->get();
        
        return $ret;
    }

    public static function adminNameOrdered(){
        $ret = config('app.cache') ? Cache::remember('category:nameOrdered',600,function(){
            return Category::orderBy('name')->get();
        }) : self::orderBy('name')->get();
        
        return $ret;
    }
    
    /**
     * @return \App\Category parent category, null for root category
     */
    public function parent(){
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function parents(){
        $ancestorsCollection = collect();
        $currentParent = $this->parent;
        while($currentParent != null){
            $ancestorsCollection->push($currentParent);
            $currentParent = $currentParent->parent;
        }

        return $ancestorsCollection->reverse();
    }

    /**
     * @return collection of category's children
     */
    public function getChildrenAttribute(){
        $id = $this->id;
        $ret = config('app.cache') ? Cache::remember('category:'.$id.':children',600,function() use($id){
            return Category::where('parent_id', $id)->where('active',true)->get();
        }) : self::where('parent_id', $id)->where('active',true)->get();
        
        return $ret;
    }

    /**
     * Relationship with products
     *
     * @return collection of \App\Product that belongs to this category
     */
    public function products(){
        return $this->hasMany(\App\Product::class, 'category_id', 'id')->where('active', true);
    }

    /**
     * @var \App\Category $childCategory
     * @return boolean, true if this category is ancestor of $childCategory
     */
    public function isAncestorOf($childCategory){
        if(is_null($childCategory)) return false;
        // starting from parent of the child category
        $tempCategory = $childCategory;

        // while is not root
        while($tempCategory){
            // true, if tempCategory equals this category
            if($tempCategory->id == $this->id)
                return true;
            $tempCategory = $tempCategory->parent;
        }
        // otherwise $this is not ancestor
        return false;
    }

    /**
     * @return int num products this category and all subcategories sumed up
     */
    public function getNumProductsAttribute(){
        $lex = $this;
        return config('app.cache') ? Cache::remember('category:'.$this->id.':num_products',600,function() use($lex){
            return count($lex->childProducts(false));
        }) : count($this->childProducts(false));
    }

    /**
     * Returns collection of all ancestors, gets the recursively
     *
     * @return mixed
     */
    public function allChildren(){
        // get all children
        $children = $this->children;
        // foreach child category call recursivly
        foreach ($this->children as $childCategory){
            $children = $children->merge($childCategory->allChildren());
        }
        
        return $children;
    }

    /**
     * Array of all subcategories ids
     *
     * @return mixed
     */
    public function allChildrenIds() : array{
        $lex = $this;
        $id = $this->id;
        $ret = config('app.cache') ? Cache::remember('category:'.$id.':ChildrenIds',600,function() use($lex){
            return $lex->allChildren()->pluck('id')->toArray();
        }) : $this->allChildren()->pluck('id')->toArray();
        
        return $ret;
    }

    /**
     * Array of all subcategories names
     *
     * @return mixed
     */
    public function allChildrenNames() : array{
        $lex = $this;
        $id = $this->id;
        $ret = config('app.cache') ? Cache::remember('category:'.$id.':ChildrenNames',600,function() use($lex){
            return $lex->allChildren()->pluck('name')->toArray();
        }) : $this->allChildren()->pluck('name')->toArray();
        
        return $ret;
    }


    /**
     * Returns paginated collection of products of this category and all children categories
     *
     * @return mixed
     */
    public function childProducts($paginate = true){
        $allAcceptedCategoriesIds = array_merge([$this->id], $this->allChildrenIds());
        $children = Product::where('active', true)->whereIn('category_id', $allAcceptedCategoriesIds)->orderByDesc('created_at');
        
        return $paginate ? $children->paginate(config('marketplace.products_per_page')) : $children->get();
    }
}
