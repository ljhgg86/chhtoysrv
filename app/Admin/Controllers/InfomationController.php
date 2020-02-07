<?php

namespace App\Admin\Controllers;

use App\Models\Infomation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InfomationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '内容列表';

    public function __construct()
    {
        $this->info = new Infomation();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Infomation);

        $grid->column('id', __('Id'));
        $grid->column('type_id', __('Type id'));
        $grid->column('title', __('Title'));
        $grid->column('readnum', __('Readnum'));
        $grid->column('realnum', __('Realnum'));
        $grid->column('toporder', __('Toporder'));
        $grid->column('status', __('Status'));
        $grid->column('publishtime', __('Publishtime'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Infomation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type_id', __('Type id'));
        $show->field('title', __('Title'));
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
        $form = new Form(new Infomation);

        $form->number('type_id', __('Type id'));
        $form->text('title', __('Title'));
        $form->text('cover1', __('Cover1'));
        $form->text('cover2', __('Cover2'));
        $form->text('cover3', __('Cover3'));
        $form->textarea('content', __('Content'));
        $form->number('readnum', __('Readnum'));
        $form->number('realnum', __('Realnum'));
        $form->number('toporder', __('Toporder'));
        $form->switch('status', __('Status'));
        $form->datetime('publishtime', __('Publishtime'))->default(date('Y-m-d H:i:s'));
        $form->text('keywords', __('Keywords'));
        $form->text('subscripts', __('Subscripts'));
        $form->switch('commentflag', __('Commentflag'));

        return $form;
    }

    public function infomationsList($typeid){
        $infoList = $this->info->getInfoByTypeid($typeid);
    }
}
