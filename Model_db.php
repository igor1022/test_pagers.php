<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'people';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['name', 'email'];


    protected $validationRules = [
        'name' => 'max_length[25]',
        'email' => 'required|valid_email|max_length[45]',
    ];

    protected $validationMessages = [
        'name' => [
            'max_length' => 'Sorry, but your name is long!'
        ],
        'email' => [
            'valid_email' => 'Sorry, but your email is not valid!',
            'max_length' => 'Sorry, but your email is long!'
        ],
    ];

    protected $skipValidation = false;

    public function findAll(int $limit = 0, int $offset = 0)
    {
        $builder = $this->builder();

        if ($this->tempUseSoftDeletes === true) {
            $builder->where($this->table . '.' . $this->deletedField, null);
        }

        /**  Added sort by DESC */
        $row = $builder->limit($limit, $offset)->orderBy('created_at', 'desc')->get();

        $row = $row->getResult($this->tempReturnType);

        $row = $this->trigger('afterFind', ['data' => $row, 'limit' => $limit, 'offset' => $offset]);

        $this->tempReturnType = $this->returnType;
        $this->tempUseSoftDeletes = $this->useSoftDeletes;

        return $row['data'];
    }
}