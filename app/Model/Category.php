<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class Category extends Model
{
    //
    use ModelTree,AdminBuilder;
    function __construct(array $attrbutes=[]){
        parent::__construct($attrbutes);
        $this->setTitleColumn('print_id');
        $this->setOrderColumn('cat_id');
        $this->setTitleColumn('cat_name');
    }
    protected $table = 'p_category';
    public $timestamps = false;
    protected $primaryKey = 'cat_id';
    protected $guarded = [];   //黑名单  create只需要开启
}
