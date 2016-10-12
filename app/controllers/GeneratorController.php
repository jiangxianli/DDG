<?php

class GeneratorController extends BaseController
{

    /**
     * 首页
     *
     * @return mixed
     * @author  jiangxianli
     * @created_at 2016-10-11 18:57:28
     */
    public function getIndex()
    {
        return View::make('generator');
    }

    /**
     * 生成数据字典
     *
     * @return array
     * @author  jiangxianli
     * @created_at 2016-10-11 18:57:47
     */
    public function postGenerator()
    {
        //数据校验
        $data      = Input::all();
        $validator = Validator::make($data,
            [
                'host'     => 'required',
                'username' => 'required',
                'database' => 'required',
            ], [
                'host.required'     => '请填写数据库连接地址',
                'username.required' => '请填写用户名',
                'database.required' => '请填写数据库',
            ]);

        if ($validator->fails()) {
            return [
                'status' => 0,
                'msg'    => $validator->errors()->first()
            ];
        }

        //数据库连接
        try {
            $dsn        = "mysql:host=" . $data['host'] . ";dbname=information_schema;charset=UTF8";
            $db         = new PDO($dsn, $data['username'], $data['password']);
            $connection = new \Illuminate\Database\Connection($db);
        } catch (Exception $exception) {
            return [
                'status' => 0,
                'msg'    => '数据库连接失败，请检查配置信息！'
            ];
        }

        $data['database'] = strtolower($data['database']);
        //非法数据库名检测
        if (in_array($data['database'], ['information_schema', 'performance_schema', 'mysql'])) {
            return [
                'status' => 0,
                'msg'    => '为保证数据库安全，此数据库名被限制！'
            ];
        }

        //数据库是否存在检测
        $sql            = "select count(*) as count from information_schema.TABLES where TABLE_SCHEMA = ?";
        $exist_database = $connection->select($sql, [$data['database']]);
        if ($exist_database[0]['count'] <= 0) {
            return [
                'status' => 0,
                'msg'    => '数据库名填写错误！'
            ];
        }

        //表结构内容
        $rows = [];

        $sql    = "select table_name,table_schema,table_comment from information_schema.TABLES where TABLE_SCHEMA = ?";
        $tables = $connection->select($sql, [$data['database']]);
        foreach ($tables as $table) {
            $arr = self::splitComment('', $table['table_comment']);
            $row = [
                'table_code'    => $table['table_name'],
                'table_name'    => $arr['name'],
                'table_comment' => $arr['comment'],
                'columns'       => []
            ];

            $sql     = "select column_name,column_type,column_default,column_comment from information_schema.COLUMNS where TABLE_SCHEMA = ? and TABLE_NAME =?";
            $columns = $connection->select($sql, [$data['database'], $table['table_name']]);
            foreach ($columns as $column) {

                $arr = self::splitComment($column['column_name'], $column['column_comment']);

                $row['columns'][] = [
                    'column_code'    => $column['column_name'],
                    'column_name'    => $arr['name'],
                    'type'           => self::formatDataType($column['column_type']),
                    'default'        => self::formatDataDefault($column['column_name'], $column['column_default']),
                    'column_comment' => $arr['comment']
                ];

            }

            $rows[] = $row;

        }

        return [
            'status' => 1,
            'view'   => View::make('template_1', compact('rows'))->render()
        ];
    }


    /**
     * 拆分说明和注释
     *
     * @param $column_name
     * @param $comment
     * @return array
     * @author  jiangxianli
     * @created_at 2016-10-11 20:12:30
     */
    public static function splitComment($column_name, $comment)
    {

        if ($column_name == 'id') {

            return [
                'name'    => '主键',
                'comment' => 'ID自动增长'
            ];
        }

        $arr = [
            'name'    => $comment ? $comment : '',
            'comment' => ''
        ];

        if (!$comment) {
            return $arr;
        }

        $position = stripos($comment, '(');
        if ($position > 0) {
            $arr['name']    = substr($comment, 0, $position);
            $arr['comment'] = substr($comment, $position + 1, strlen($comment) - $position - 2);
        }
        return $arr;

    }

    /**
     * 数据类型转换
     *
     * @param $type
     * @return string
     * @author  jiangxianli
     * @created_at 2016-10-11 20:12:49
     */
    public static function formatDataType($type)
    {

        switch ($type) {
            case 'int(11) unsigned':
            case 'int(10) unsigned':
                return strtoupper('int(10)');
                break;
            case 'tinyint(3) unsigned':
                return strtoupper('tinyint(3)');
                break;
            case  'tinyint(1) unsigned':
                return strtoupper('tinyint(1)');
                break;
            default:
                return strtoupper($type);
        }
    }

    /**
     * 处理默认值显示
     *
     * @param $column
     * @param $default
     * @return string
     * @author  jiangxianli
     * @created_at 2016-10-11 20:13:06
     */
    public static function formatDataDefault($column, $default)
    {

        if (in_array($column, ['id'])) {
            return '';
        }
        if (is_null($default)) {
            return 'NULL';
        }
        if ($default === '') {
            return '空字符串';
        }

        return $default;

    }

}
