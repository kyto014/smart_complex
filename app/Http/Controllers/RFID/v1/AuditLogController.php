<?php

namespace App\Http\Controllers;

use App\Models\RFID\v1\Audit_log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create( $operation, $result, $person_id, $message)
    {
        $timestamp = Carbon::now();
        $auditLog = new Audit_log();

        $auditLog->timestamp = $timestamp;

        if (preg_match("/.+/",$operation)){
            $auditLog->operation = $operation;
        } else{
            $auditLog->operation = "Operation has not been set.";
        }

        if (preg_match("/.+/",$result)){
            $auditLog->result = $result;
        } else{
            $auditLog->result = "Result has not been set.";
        }

        if (preg_match("/.+/",$person_id)){
            $auditLog->person_id = $person_id;
        } else{
            $auditLog->person_id = Null;
        }

        if (preg_match("/.+/",$message)){
            $auditLog->message = $message;
        } else{
            $auditLog->message = "No message to this log.";
        }

        $auditLog->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show(Audit_log $audit_log)
    {
        //
    }


    public function edit(Audit_log $audit_log)
    {
        //
    }


    public function update(Request $request, Audit_log $audit_log)
    {
        //
    }


    public function destroy(Audit_log $audit_log)
    {
        //
    }
}
