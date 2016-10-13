<?php

class GeneratorController extends BaseController
{
    public $host = 'localhost';
    public $username = 'root';
    public $password = '';
    public $database = '';
    public $document_name = '数据库字典';

    public function __construct()
    {
        $this->host          = Input::get('host', $this->host);
        $this->username      = Input::get('username', $this->username);
        $this->password      = Input::get('password', $this->password);
        $this->database      = Input::get('database', $this->database);
        $this->document_name = Input::get('document_name', $this->document_name);
        $this->document_name = $this->document_name ? $this->document_name : '数据库字典';
    }

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
        $params = [
            'host'     => $this->host,
            'username' => $this->username,
            'password' => $this->password,
            'database' => $this->database
        ];

        $check = self::connectCheck($params);
        if ($check['status'] == 0) {
            return $check;
        }

        $rows  = self::columnRows($params);
        $title = $this->document_name;
        return [
            'status' => 1,
            'view'   => View::make('template_1', compact('rows', 'title'))->render()
        ];
    }

    /**
     * 导出Word文档
     *
     * @return mixed
     * @throws \PhpOffice\PhpWord\Exception\Exception
     * @author  jiangxianli
     * @created_at 2016-10-13 16:41:14
     */
    public function generateWord()
    {
        $storage_word_dir = storage_path('word');
        if (!file_exists($storage_word_dir)) {
            mkdir($storage_word_dir, 0755, true);
        }

        $params = [
            'host'     => $this->host,
            'username' => $this->username,
            'password' => $this->password,
            'database' => $this->database
        ];

        $check = self::connectCheck($params);
        if ($check['status'] == 0) {
            return View::make('generator')->withErrors([$check['msg']]);
        }
        $rows = self::columnRows($params);

        // Create a new PHPWord Object
        $PHPWord       = new \PhpOffice\PhpWord\PhpWord();
        $PHPWordHelper = new \PhpOffice\Common\Font();

        $PHPWord->setDefaultFontName('宋体'); // 全局字体
        $PHPWord->setDefaultFontSize(14);     // 全局字号为3号

        // 设置文档的属性，这些在对文档右击属性可以看到，也可以省去这些步骤
        $properties = $PHPWord->getDocumentProperties();
        $properties->setCreator('jiangxianli');   // 创建者
        $properties->setCompany('https://github.com/jiangxianli'); // 公司
        $properties->setTitle('Mysql数据字典生成器'); // 标题
        $properties->setDescription('https://github.com/jiangxianli'); // 描述
        $properties->setLastModifiedBy('jiangxianli'); // 最后修改
        $properties->setCreated(time());      // 创建时间
        $properties->setModified(time());     // 修改时间

        //设置不同级别标题样式
        $PHPWord->addTitleStyle(2, ['name' => '宋体', 'size' => 20, 'bold' => true]);
        $PHPWord->addTitleStyle(3, ['name' => '宋体', 'size' => 18, 'bold' => true]);

        //段落样式
        //注意这里厘米(centimeter)要转换为twips单位
        $sectionStyle = array(
            'orientation'        => null,
            //'marginLeft'         => $PHPWordHelper->centimeterSizeToTwips(3),
            'marginRight'        => $PHPWordHelper->centimeterSizeToTwips(3),
            'marginTop'          => $PHPWordHelper->centimeterSizeToTwips(3.5),
            'marginBottom'       => $PHPWordHelper->centimeterSizeToTwips(3.8),
            'pageNumberingStart' => 1, // 页码从1开始
            'footerHeight'       => $PHPWordHelper->centimeterSizeToTwips(3),
        );

        //添加一节
        $section = $PHPWord->addSection($sectionStyle);

        /************************* 添加标题 **********************************/
        //新起10个空白段落
        $section->addTextBreak(10);
        //文档标题
        $section->addText($this->document_name,
            ['name' => '宋体', 'size' => 24],
            ['align' => 'center']
        );
        //插入分页符
        $section->addPageBreak();

        /************************* 添加实体目录 **********************************/
        //实体目录表格
        $section->addTitle('I 实体目录', 2);
        $table_style = array('borderColor' => '000000', 'borderSize' => 1);
        $table       = $section->addTable($table_style);
        //列宽度
        $cell_width = [
            $PHPWordHelper->centimeterSizeToTwips(5.8),
            $PHPWordHelper->centimeterSizeToTwips(5.8),
            $PHPWordHelper->centimeterSizeToTwips(6),
        ];
        //列标题
        $cell_title     = ['Name', 'Code', 'Comment'];
        $styleParagraph = array('align' => 'left', 'spaceAfter' => 2,);

        $table->addRow();
        $cell_font = ['name' => '宋体', 'size' => 12];
        foreach ($cell_title as $key => $title) {
            $table->addCell($cell_width[$key])->addText($title, $cell_font, $styleParagraph);
        }

        foreach ($rows as $key => $row) {
            $table->addRow();
            $table->addCell($cell_width[0])->addText($row['table_code'], $cell_font, $styleParagraph);
            $table->addCell($cell_width[1])->addText($row['table_code'], $cell_font, $styleParagraph);
            $table->addCell($cell_width[2])->addText($row['table_comment'], $cell_font, $styleParagraph);

        }
        $section->addPageBreak();

        /************************* 添加实体清单 **********************************/
        $section->addTitle('II 实体清单', 2);
        foreach ($rows as $key => $row) {
            $section->addTitle('II.' . ($key + 1) . ' ' . $row['table_code'] . ' ( ' . $row['table_name'] . ' )', 3);
            $section->addTextBreak(1); // 新起一个空白段落

            $table_style = array('borderColor' => '000000', 'borderSize' => 1);
            $table       = $section->addTable($table_style);
            $cell_width  = [
                $PHPWordHelper->centimeterSizeToTwips(3),
                $PHPWordHelper->centimeterSizeToTwips(3),
                $PHPWordHelper->centimeterSizeToTwips(3),
                $PHPWordHelper->centimeterSizeToTwips(2.2),
                $PHPWordHelper->centimeterSizeToTwips(5),
            ];
            $cell_title  = ['字段', '名称', '数据类型', '默认值', '注释说明'];

            $styleParagraph = array('align' => 'left', 'spaceAfter' => 100,);
            $table->addRow();
            $cell_font = ['name' => '宋体', 'size' => 12];
            foreach ($cell_title as $key => $title) {
                $table->addCell($cell_width[$key])->addText($title, $cell_font, $styleParagraph);
            }

            foreach ($row['columns'] as $key => $column) {
                $table->addRow();
                $table->addCell($cell_width[0])->addText($column['column_code'], $cell_font, $styleParagraph);
                $table->addCell($cell_width[1])->addText($column['column_name'], $cell_font, $styleParagraph);
                $table->addCell($cell_width[2])->addText($column['type'], $cell_font, $styleParagraph);
                $table->addCell($cell_width[3])->addText($column['default'], $cell_font, $styleParagraph);
                $table->addCell($cell_width[4])->addText($column['column_comment'], $cell_font, $styleParagraph);

            }

            $section->addTextBreak(1); // 新起一个空白段落
        }

        $objWriter    = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
        $h2d_file_uri = $storage_word_dir . '/' . time() . '-' . rand(10000, 99999) . '.docx';
        $objWriter->save($h2d_file_uri); // 保存到/path/to/file路径下

        return Response::download($h2d_file_uri, $this->document_name . '-' . \Carbon\Carbon::now()->format('YmdHis') . '.docx');
    }

    /**
     * 生成结构数据
     *
     * @param $data
     * @return array
     * @author  jiangxianli
     * @created_at 2016-10-13 16:25:35
     */
    public static function columnRows($data)
    {
        //数据库连接
        $dsn        = "mysql:host=" . $data['host'] . ";dbname=information_schema;charset=UTF8";
        $db         = new PDO($dsn, $data['username'], $data['password']);
        $connection = new \Illuminate\Database\Connection($db);

        $data['database'] = strtolower($data['database']);

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

        return $rows;
    }

    /**
     * 连接数据检测
     *
     * @param $data
     * @return array
     * @author  jiangxianli
     * @created_at 2016-10-13 16:25:05
     */
    public static function connectCheck($data)
    {
        //数据校验
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

        return [
            'status' => 1,
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
