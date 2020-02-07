<div class="row pull-right">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span>新建
        </button>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>标题</th>
            <th>最后修改时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($infoList as $info)
        <tr>
            <td>{{ $info->title }}</td>
            <td>{{ $inf0->updated_time }}</td>
            <td>{{ $info->status }}</td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">操作
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="#">编辑</a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="#">发布</a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="#">撤稿</a>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="#">删除</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $infoList->links() }}
