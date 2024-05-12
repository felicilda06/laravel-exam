<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    public function index(){
        $announcement = Announcement::all();

        return view('users.announcement', ['announcements'=>$announcement]);
    }
    public function store(Request $req){
        $validator = Validator::make($req->all(), [
            'title'=>'required',
            'content'=>'required',
            'startDate'=>'required',
            'endDate'=>'required'
        ]);

        if($validator->fails()){
            return response(['message'=>$validator->messages()], 400);
        }else{
            try{
                $announcement = new Announcement();
                $announcement->title = $req->title;
                $announcement->content = $req->content;
                $announcement->startDate = $req->startDate;
                $announcement->endDate = $req->endDate;
                $announcement->active = $req->active || 0;
                $announcement->save();

                return response(['message'=> 'Announcement Created'], 200);

            }catch(err){
                return response(['message'=>'Announcement Already Exist'], 500);
            }
        }
    }
    public function getById($id){
        try{
          $announcement = DB::table('announcements')
          ->where('id', $id)
          ->get()
          ->first();

          return response(['announcement'=> $announcement], 200);
        }catch(err){
           return response(['message'=> err.message], 500);
        }
    }
    public function update(Request $req, $id){
      try{
        $announcement = Announcement::find($id);
        $announcement->title = $req->title;
        $announcement->content = $req->content;
        $announcement->startDate = $req->startDate;
        $announcement->endDate = $req->endDate;
        $announcement->update();

        return response(['message'=> 'Record Update Successfully'], 200);
      }catch(err){
        return response(['message'=> err.message], 500);
      }
    }
    public function delete($id){
      try{
        $announcement = Announcement::find($id);
        $announcement->delete();
        return response(['message'=> 'Record Deleted Successfully'], 200);
      }catch(err){
        return response(['message'=> err.message], 500);
      }

    }
}
