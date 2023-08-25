<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ctrClienteTmp extends Controller
{

    public function criarTMP()
        {
        $clttmp = DB::statement("CREATE TEMPORARY TABLE IF NOT EXISTS clientetmp(
        tmpid INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        NIC varchar(100),
        Designation varchar(100),
        WorkPlace varchar(100),
        Initials varchar(100),
        LastName varchar(100),
        DOB DATE,
        Mobile varchar(10),
        FirstAppoinment DATE,
        DutyAssumeDate  DATE
            )");
      $clttmp = DB::Select( 'select * from clientetmp');
        
        return $clttmp;
        }

  

    public function listar()
    {
        $clttmp = DB::Select( 'select * from clientetmp');
        
        return $clttmp;
    }
    
    
}
