<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:images {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert images to nextgen format (webp)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $path = $this->argument('path');
        $verbose = $this->option('verbose');

        switch($path){
            case 'public':
                $path = public_path();
                break;
                
            case 'storage':
                $path = public_path()."/storage/products";
                break;
                
            default:
                $this->error('invalid path value should be: (public|storage) got: '.$path);
                return;
        }
        
        $files = $this->withProgressBar(scandir($path), function ($file) use($path,$verbose){
            if($file == '.' || $file == '..' || !is_file($path."/$file")){
                return;
            }
            
            $image = exif_imagetype("$path/$file");
            $mime_type = image_type_to_mime_type($image); 
            
            $mime = array();
            if(!preg_match('/^image\/(.+)/', $mime_type,$mime)){
                if($verbose){
                    $this->error("Failed to obtain mime type of file: $path/$file");
                }
                return;
            }
            
            $extension = array();
            if(!preg_match('/\.([A-Za-z0-9]+)/', $file, $extension)){
                if(!rename("$path/$file","$path/$file.$mime")){
                    if($verbose){
                        $this->error("Failed to rename file: $path/$file -> $path/$file.".$mime[1]);
                    }
                    return;
                }
            }elseif($mime[1] != $extension && !preg_match('/(jpe?g){2}/', $extension[1].$mime[1])){
                if(!rename($path."/$file",$path.'/'.substr($file, 0, -strlen($extension[1])).$mime[1])){
                    if($verbose){
                        $this->error("Failed to rename file: $path/$file -> $path/".substr($file, 0, -strlen($extension[1])).$mime[1]);
                    }
                    return;
                }
            }
            
            if(file_exists($path.'/'.substr($file, 0, -strlen($extension[1])).'webp')){
                $this->line("Next-gen format image already exists for file: $path/$file");
                return;
            }
            
            switch($mime[1]){
                case 'jpeg':
                case 'jpg':
                    if(!$this->convertImage("$path/$file","$path/".substr($file, 0, -strlen($extension[1])).'webp',80)){
                        $this->error("Failed to convert file: ".$path."/$file");
                        return;
                    }
                    break;
                    
                case 'gif':
                    break;
                    
                case 'png':
                    if(!$this->convertImage("$path/$file","$path/".substr($file, 0, -strlen($extension[1])).'webp',80)){
                        $this->error("Failed to convert file: $path/$file");
                        return;
                    }
                    break;
                    
                case 'webp':
                    return;
                    
                case 'ico':
                    return;
                    
                default:
                    $this->error("Unknown image mime type: ".$mime[1]." for file: $path./$file");
                    return;
            }
            
            
        });
        
        $this->newLine();
        $this->info('The command was successful!');
        
        return 0;
    }
    
    protected function convertImage(string $path, string $output, int $quality) : bool{
        try{
            $image = new \Imagick();
            $image->readImage($path);

            //$image->setImageFormat('webp');
            $image->setImageCompressionQuality($quality);
            $image->setOption('webp:lossless', 'true');

            $image->writeImage('webp:'.$output);
        }catch(Exception $e){
            $this->error("Exception caught while converting: $path to: $output");
            return false;
        }

        return true;
    }
}
