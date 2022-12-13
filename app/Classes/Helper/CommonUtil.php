<?php

namespace App\Classes\Helper;

use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;

/**
 * Helper class for retrieving menus
 */
class CommonUtil
{

    /**
     * Helper method to create directory if not exist
     *
     * @param $path
     *
     * @return bool
     */
    public static function createDirIfNotExist( $path ) {
        if (! File::exists(public_path($path))) {
            if(File::makeDirectory(public_path($path),0777,true)){
                return true;
            } else {
                return false;
            }
        } else{
            return true;
        }
    }

	/**
	 * Get Image Url
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public static function getUrl($path) {
        return Storage::disk('public')->url($path);
	}

    /**
     * Remove File Form Folder
     *
     * @param $path
     *
     * @return bool
     */
    public static function removeFile( $path ) {
        Storage::disk('public')->delete($path);
        return true;
    }

    /**
     * Upload File Form Folder
     *
     * @param $file
     * @param $folder
     *
     * @return bool
     */
    public static function uploadFileToFolder( $file, $folder ) {
        $path = Storage::disk('public')->putFile($folder, $file);
        return $path;
    }

	/**
	 * Date Convert To Add Database
	 *
	 * @param $date
	 *
	 * @return string
	 */
    public static function dateForDatabase($date){
	    $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
	    return $date;
    }

	/**
	 * Delete Element from Multidimensional Array based on value
	 *
	 * @param $array
	 * @param $key
	 * @param $value
	 *
	 * @return mixed
	 */
	public static function removeElementWithValue($array, $key, $value){
		$array = json_decode(json_encode($array), true);
		foreach($array as $subKey => $subArray){
			if($subArray[$key] == $value){
				unset($array[$subKey]);
			}
		}
		$array = array_values($array);
		$array = json_decode( json_encode( $array ) );
		return $array;
	}
}
