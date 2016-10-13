<div class="document-title">
    <h4> {{ $title }}</h4>
</div>
<div class="table-list">
    <div class="table-title">
        I 实体目录
    </div>
    <table class="table table-bordered">
        <tr class="">
            <th>Name</th>
            <th>Code</th>
            <th>DESC</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td> {{ $row['table_code'] }}</td>
                <td> {{ $row['table_name'] }}</td>
                <td> {{ $row['table_comment'] }}</td>
            </tr>
        @endforeach
    </table>
</div>

<div class="">
    <div class="table-title">
        II 实体清单
    </div>
    @foreach($rows as $key => $row)
        <div id="{{ $row['table_code'] }}">
            <div class="table-title">
                II.{{ $key+1  }} {{  $row['table_code'] }} ( {{ $row['table_name'] }} )</b>
            </div>
            <table class="table table-bordered">
                <tr class="">
                    <th width="18%">字段</th>
                    <th width="20%">名称</th>
                    <th width="16%">数据类型</th>
                    <th width="12%">默认值</th>
                    <th>注释说明</th>
                </tr>
                @foreach($row['columns'] as $column)
                    <tr>
                        <td> {{ $column['column_code'] }}</td>
                        <td> {{ $column['column_name'] }}</td>
                        <td> {{ $column['type'] }}</td>
                        <td> {{ $column['default'] }}</td>
                        <td> {{ $column['column_comment'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach
</div>

<div class="quick-find">
    <div class="table-title text-center">
        快速查找
    </div>
    <ul>
        @foreach($rows as $key => $row)
            <li><a href="#{{ $row['table_code'] }}" title="{{ $row['table_name'] }}">{{ $key+1 }}.{{ $row['table_code'] }}</a></li>
        @endforeach
    </ul>
</div>
