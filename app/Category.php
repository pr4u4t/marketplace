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


    /**
     * Returns collection of root categories
     *
     * @return \Illuminate\Support\Collection
     */
    public static function roots($ordby = 'name', $order = 'asc'){
        $ret = config('app.cache') ? Cache::remember('category:roots:'.$ordby.':'.$order,600,function() use($ordby,$order){
            return category::whereNull('parent_id')->orderBy($ordby,$order)->get();
        }) : self::whereNull('parent_id')->orderBy($ordby,$order)->get();
        
        return $ret;
    }

    /**
     * Returns the collection of all categories A-Z ordered
     *
     * @return \Illuminate\Support\Collection
     */
    public static function nameOrdered(){
        $ret = config('app.cache') ? Cache::remember('category:nameOrdered',600,function(){
            return category::orderBy('name')->get();
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
            return category::where('parent_id', $id)->get();
        }) : self::where('parent_id', $id)->get();
        
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
            if($tempCategory-> id == $this->id)
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
        if(!config('app.cache')){
            $numProducts = count($this->products);

            $otherCategories = Category::where('id', '<>', $this->id)->get();
            foreach($otherCategories as $categ){
                if($this->isAncestorOf($categ))
                    $numProducts += count($categ->products);
            }
            
            return $numProducts;
        }else{
            $lex = $this;
            return Cache::remember('category:'.$this->id.':NumProducts',600,function() use($lex){
                $numProducts = count($lex->products);
                
                $otherCategories = Category::where('id', '<>', $lex->id)->get();
                foreach($otherCategories as $categ){
                    if($lex->isAncestorOf($categ))
                        $numProducts += count($categ->products);
                }
                
                return $numProducts; 
            });
        }
    }

    /**
     * Returns collection of all ancestors, gets the recursivly
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
    public function childProducts(){
        $allAcceptedCategoriesIds = array_merge([$this->id], $this->allChildrenIds());
        return Product::where('active', true)->whereIn('category_id', $allAcceptedCategoriesIds)->orderByDesc('created_at')
            ->paginate(config('marketplace.products_per_page'));
    }
}
