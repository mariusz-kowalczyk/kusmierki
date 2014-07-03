<?php

/**
 * Description of ImageController
 *
 * @author Mariusz Kowalczyk
 */
class ImageController extends BaseController {
    
    public function upload($gallery) {
        if (Input::hasFile('file'))
        {
            $image = new Image();
            $image->user_id = Auth::id();
            $image->gallery_id = $gallery->id;
            $file = Input::file('file');
            $name = $file->getClientOriginalName();
            $image->name = $name;
            $image->save();
            $fileName = 'orginal';
            $destinationPath = Config::get('app.images_path') . $image->id;
            $extension = $file->getClientOriginalExtension();
            @mkdir($destinationPath);
            $file->move($destinationPath, $fileName);
            copy($destinationPath . '/orginal', $destinationPath . '/32');
            copy($destinationPath . '/orginal', $destinationPath . '/64');
            copy($destinationPath . '/orginal', $destinationPath . '/128');
            copy($destinationPath . '/orginal', $destinationPath . '/1024');
            MK\Image::resize($destinationPath . '/32', $extension, 32, 32);
            MK\Image::resize($destinationPath . '/64', $extension, 64, 64);
            MK\Image::resize($destinationPath . '/128', $extension, 128, 128);
            MK\Image::resize($destinationPath . '/1024', $extension, 1024, 800);
            
            return Response::json(array(
                'success'   => true,
                'image' => $image->toArray()
            ));
        }else {
            return Response::json(array(
                'success'   => false,
                'message'   => 'no image'
            ));
        }
    }
    
    public function download($image = null) {
        $ext = explode('.', $image->name);
        $ext = end($ext);
        $filename = Config::get('app.images_path') . $image->id . '/orginal';
        header('Content-Type: image/' . strtolower($ext));
        header('Content-Disposition: attachment; filename="' . $image->name . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        
        if(file_exists($filename)) {
            echo file_get_contents($filename);
        }
        
        die;
    }
    
    /**
     * 
     * @param Image $image
     */
    public function edit($image = null) {
        $this->view->with('image', $image);
        $tmp = explode('.', $image->name);
        $this->view->with('extension', end($tmp));
        array_pop($tmp);
        $this->view->with('name_part', implode('.', $tmp));
    }
    
    /**
     * 
     * @param array $data
     * @param Image $item
     */
    public function preEditFill($data, $item = null) {
        $tmp = explode('.', $item->name);
        $extension = end($tmp);
        $data['name'] .= '.' . $extension;
        return $data;
    }
}
