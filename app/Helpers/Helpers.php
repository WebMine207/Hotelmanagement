<?php

/* Encryption Id */
function getEncrypted($id){
    $encrypted_string=openssl_encrypt($id,config('services.encryption.type'),config('services.encryption.secret'));
    return base64_encode($encrypted_string);
}
/* Decryption Id */
function getDecrypted($id){
    $string=openssl_decrypt(base64_decode($id),config('services.encryption.type'),config('services.encryption.secret'));
    return $string;
}

/* Footer title */
function footer_title(){
    return "Copyright &copy; ".date('Y').' ' .env('APP_NAME').". All rights reserved.";
}

/* Active Sidebar */
function getActiveClass($routes = [],$is_default=0)
{
    $class = '';
    if(in_array(\Route::currentRouteName(), $routes)){
        $class = "active";
        if($is_default == 1){
            $class = "hover show";
        }elseif($is_default == 2){
            $class = "menu-active-bg";
        }
    }
    return $class;
}

/* Breadcrumb */
function setBreadCrumb($title,$url=null,$is_first=0){
    $html = '';
    if($is_first != 1){
        $html = '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>';
    }
    if($url != null){
        $html .='<li class="breadcrumb-item text-muted"> <a href="'.$url.'" class="text-muted text-hover-primary">'.$title.'</a></li>';
    }else{
        $html .='<li class="breadcrumb-item text-dark">'.$title.'</li>';
    }
    return $html;
}


