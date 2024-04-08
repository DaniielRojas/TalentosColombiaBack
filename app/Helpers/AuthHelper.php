<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function isAdmin()
    {
        return Auth::check() && Auth::user()->id_rol === 1;
    }

    public static function isStudent()
    {
        return Auth::check() && Auth::user()->id_rol === 2;
    }

    public static function isTeacher()
    {
        return Auth::check() && Auth::user()->id_rol === 3;
    }

    public static function isCourseTeacher($courseTeacherId)
    {
        return Auth::check() && Auth::id() === $courseTeacherId;
    }

    public static function isCurrentUser($userId)
    {
        return Auth::check() && Auth::id() == $userId;
    }

    public static function isUserEnrolledInCourse($courseId)
    {
        return Auth::check() && Auth::user()->cursosEstudiante->contains('id_curso', $courseId);
    }
} 