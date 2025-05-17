<?php

namespace App\Models;
use CodeIgniter\Model;

class DreamModel extends Model
{
    protected $table = 'dreams';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'tags', 'image_url', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = ''; 
}