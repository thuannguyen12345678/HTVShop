<?php

namespace App\Repositories\Api\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isNull;

class BrandApiRepository extends BaseRepository implements BrandApiRepositoryInterface
{

    function getModel()
    {
        return Brand::class;
    }

    public function all($request)
    {
        return $this->model->with('products')->latest()->get();
    }
    public function create($data)
    {
        if ($data['image']) {
            $file = $data['image'];
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time(); // create file name by curent time
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            $path = 'storage/images/brand/' . $newFileName;
            $data['image']->storeAs('public/images/brand', $newFileName); //save file in public/images/brand with newname is newFileName
            $data['image'] = $path;
        }
        return $this->model->create($data);
    }
    public function update($id, $data)
    {
        $object = $this->model->find($id);
        // dd(!empty($data['image']));
        if (!empty($data['image'])) {
            $file = $data['image'];
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time(); // create file by curent time
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            $path = 'storage/images/brand/' . $newFileName;
            $data['image']->storeAs('public/images/brand', $newFileName);// save file in public/images/brand with newname is newFileName
            $data['image'] = $path;
        } else {
            $data['image'] = $object->image;
        }
        return $object->update($data);
    }
    public function trashedItems()
    {
        return  $this->model->onlyTrashed()->paginate(8);
    }
    public function restore($id){
        return  $this->model->withTrashed()->where('id', $id)->restore();
    }
    public function force_destroy($id)
    {
        return  $this->model->withTrashed()->where('id', $id)->force_destroy();

    }
    public function searchBrand($name){
        $brands =  $this->model::where('name', 'like', '%' . $name . '%')
        ->orWhere('image', 'like', '%' . $name . '%');
        if(Route::currentRouteName() =='brand.searchKey'){
            return  $brands->get();
          }
          return  $brands->paginate(8);
    }


}