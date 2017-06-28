public function postCrop()
{
$form_data = Input::all();
$image_url = $form_data['imgUrl'];

// resized sizes
$imgW = $form_data['imgW'];
$imgH = $form_data['imgH'];
// offsets
$imgY1 = $form_data['imgY1'];
$imgX1 = $form_data['imgX1'];
// crop box
$cropW = $form_data['width'];
$cropH = $form_data['height'];
// rotation angle
$angle = $form_data['rotation'];

$filename_array = explode('/', $image_url);
$filename = $filename_array[sizeof($filename_array)-1];

$manager = new ImageManager();
$image = $manager->make( $image_url );
$image->resize($imgW, $imgH)
->rotate(-$angle)
->crop($cropW, $cropH, $imgX1, $imgY1)
->save(env('UPLOAD_PATH') . 'cropped-' . $filename);

if( !$image) {

return Response::json([
'status' => 'error',
'message' => 'Server error while uploading',
], 200);

}

return Response::json([
'status' => 'success',
'url' => env('URL') . 'uploads/cropped-' . $filename
], 200);

}