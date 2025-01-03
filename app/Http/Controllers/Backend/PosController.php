<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\PosInterface;
use Illuminate\Http\Request;

class PosController extends Controller
{
    protected $posRepository;
    public function __construct(PosInterface $posRepository)
    {
        $this->posRepository = $posRepository;
    }

    public function pos(){
        return $this->posRepository->pos();
    }
}
