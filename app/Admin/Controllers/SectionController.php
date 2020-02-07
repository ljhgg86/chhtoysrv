<?php

namespace App\Admin\Controllers;

use App\Models\Section;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '板块';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Section);

        $grid->column('id', __('序号'));
        $grid->column('name', __('名称'));
        $grid->column('order', __('排序'));
        $grid->column('delflag', __('删除'))->display(function ($delflag) {
            return $delflag ? '是' : '否';
        });;
        $grid->model()->orderBy('order');

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
        $show = new Show(Section::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('order', __('Order'));
        $show->field('delflag', __('Delflag'));
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
        $form = new Form(new Section);

        $form->text('name', __('Name'));
        $form->number('order', __('Order'));
        $form->switch('delflag', __('Delflag'));

        return $form;
    }
}
