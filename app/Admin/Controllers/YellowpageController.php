<?php

namespace App\Admin\Controllers;

use App\Models\Yellowpage;
use App\Models\Type;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Layout\Content;

class YellowpageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '内容列表';

    public function __construct()
    {
        $this->yp = new Yellowpage();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($typeid=0)
    {
        $types = Type::where('delflag', 0)->pluck('name', 'id');
        $grid = new Grid(new Yellowpage);

        if($typeid){
            $grid->model()->where('type_id',$typeid);
        }
        else{
            $grid->filter(function ($filter) use($types) {

                $filter->disableIdFilter();
                $filter->equal('type_id', '类型')->select($types);
            });
        }

        $grid->model()->orderBy('id','desc');

        $grid->column('type_id', __('类型'))->display(function($type_id){
            $type = Type::find($type_id);
            return $type->name;
        });
        $grid->column('title', __('标题'));
        $grid->column('readnum', __('阅读数'));
        $grid->column('status', __('状态'))->display(function($status){
            $str = "草稿";
            switch($status){
                case 1:$str = "已发";break;
                case 2:$str = "删除";break;
                default:break;
            }
            return $str;
        });
        $grid->column('publishtime', __('发布时间'));
        $grid->column('updated_at', __('最后编辑时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Yellowpage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type_id', __('Type id'));
        $show->field('title', __('Title'));
        $show->field('address', __('Address'));
        $show->field('postion', __('Postion'));
        $show->field('phone', __('Phone'));
        $show->field('contactperson', __('Contactperson'));
        $show->field('cover1', __('Cover1'));
        $show->field('cover2', __('Cover2'));
        $show->field('cover3', __('Cover3'));
        $show->field('content', __('Content'));
        $show->field('readnum', __('Readnum'));
        $show->field('realnum', __('Realnum'));
        $show->field('toporder', __('Toporder'));
        $show->field('status', __('Status'));
        $show->field('publishtime', __('Publishtime'));
        $show->field('keywords', __('Keywords'));
        $show->field('subscripts', __('Subscripts'));
        $show->field('commentflag', __('Commentflag'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $types = Type::where('delflag', 0)->pluck('name', 'id');
        //$types = json_encode($types);
        $form = new Form(new Yellowpage);

        $form->fieldset('基本信息', function($form) use ($types) {
            $form->select('type_id', __('类型'))->options($types)->rules('required');
            $form->text('title', __('标题'))->rules('required');
            $form->text('address', __('地址'))->rules('required');
            $form->mobile('phone', __('电话'));
            $form->text('contactperson', __('联系人'));
        });
        $form->fieldset('详细信息', function($form){
            $form->image('cover1', __('封面1'))->removable()->thumbnail('small', $width = 300, $height = 300);
            $form->image('cover2', __('封面2'))->removable()->thumbnail('small', $width = 300, $height = 300);
            $form->image('cover3', __('封面3'))->removable()->thumbnail('small', $width = 300, $height = 300);
            $form->textarea('content', __('内容'))->rows(3);
            //$form->map('latitude', 'longitude', '位置');
            $form->latlong('latitude', 'longitude', '位置');
        });
        $form->fieldset('更多', function($form){
            $form->radio('status', __('状态'))->options(['0'=> '草稿','1'=> '发布','2'=>'删除'])->default('1');
            $form->datetime('publishtime', __('发布时间'))->default(date('Y-m-d H:i:s'));
            $form->text('keywords', __('关键词'));
            $form->text('subscripts', __('下角标'));
            $form->switch('commentflag', __('评论'));
        });

        return $form;
    }

    public function infomationsList($typeid){
        $content = new Content();
        $infoList = $this->yp->getInfoByTypeid($typeid);
        //$content->view('infolist',compact('infoList'));
        $content->header('内容列表');
        $content->body($this->grid($typeid));
        return $content;
    }

}
