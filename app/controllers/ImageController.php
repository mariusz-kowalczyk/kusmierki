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
            copy($destinationPath . '/orginal', $destinationPath . '/800');
            MK\Image::resize($destinationPath . '/32', $extension, 32, 32);
            MK\Image::resize($destinationPath . '/64', $extension, 64, 64);
            MK\Image::resize($destinationPath . '/128', $extension, 128, 128);
            MK\Image::resize($destinationPath . '/128', $extension, 800, 600);
            
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
    
}
