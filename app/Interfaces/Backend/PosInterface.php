<?php 
namespace App\Interfaces\Backend;

interface PosInterface{

    public function pos();
    public function addCart($request);
    public function allItem();
    public function cartUpdate($request,$id);
    public function cartRemove($id);
}