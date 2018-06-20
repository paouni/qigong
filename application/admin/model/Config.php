<?php

namespace app\admin\model;

use think\Model;

class Config extends Model
{
    // 是否需要自动写入时间戳 如果设置为字符串 则表示时间字段的类型
    protected $autoWriteTimestamp = false;

    /**
     * sort_order排序后的栏目列表
     * @return mixed
     */
    public function all_list()
    {
        return $this->order('sort_order asc')->select();
    }

    /**
     * 配置 输入html格式
     * @return mixed
     */
    public function html_list()
    {
        $data = $this->all_list();
        foreach ($data as $k => $v) {
            $str = ''; //radio 拼接出错，需要每次循环清空
            switch ($v->field_type) {
                case 'input' :
                    $str = '<input type="text" class="layui-input" size="70" name="' . $v->en_name . '" value="' . $v->content . '">';
                    break;
                case 'textarea':
                    $str = '<textarea class="layui-textarea" name="' . $v->en_name . '">' . $v->content . '</textarea>';
                    break;
                case 'radio':
                    //1.先用,拆分  1|开启,0|关闭
                    $arr = explode(',', $v->field_value); // $arr = ['1|开启', '0|关闭']

                    foreach ($arr as $kk => $vv) {
                        $value = explode('|', $vv); //$value = ['1', '开启']

                        $flag = ($value[0] == $v->content) ? 'checked' : ''; // 判断单选框的选项

                        $str .= '<input type="radio" name="' . $v->en_name . '" value="' . $value[0] . '" ' . $flag . '>' . $value[1] . '　';
                    }
                    break;
                case 'img':
                    $str = '<img src="' . __ROOT__ . '/' . $v->content . '" /> <input type="hidden" name="' . $v->en_name . '" value="' . $v->content . '" />';
                    break;
            }
            $data[$k]['_html'] = $str;
        }
        return $data;
    }

    /**
     * 保存配置设置，并写入 extra/web.php 中保存
     * @param array $data
     * @return bool
     */
    public function save_config($data = array())
    {
        //删除指定的key
        if (isset($data['ord'])) {
            unset($data['ord']);
        }
        $flag = 1;
        //批量更新仅能根据主键值进行更新，其它情况请使用foreach遍历更新
        foreach ($data as $k => $v) {
            //判断k,v是数组的话，跳过
            if (is_array($k) || is_array($v)) {
                continue;
            }
            $rs = $this->where('en_name', $k)->update(['content' => $v]);
            if ($rs === false) {
                $flag = 0;
            }
        }
        $rs = $this->database_to_file();
        if ($flag && $rs) {
            return true;
        } else {
            return false;
        }
    }

    //写入配置文件
    public function database_to_file()
    {
        //方法一：
        $config = $this->column('content', 'en_name');//直接生成二维关联数组
        $str = '<?php return ' . var_export($config, true) . ';?>';
        $rs = file_put_contents(ROOT_PATH . 'application/extra/web.php', $str);
        if ($rs !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 模型数据验证
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        //17年 6月18日新增  验证场景的使用 + 是否更新操作 //$update = isset($data['id']) ? ['id' => $data['id']] : []; //是否更新操作
        $rule = isset($data['id']) ? \think\Request::instance()->controller() . '.edit' : true;
        //17年 6月12日 修改，使用验证器验证规则的设置。
        $result = $this->validate($rule)->allowField(true)->save($data, $rule === true ? false : true);
        if (false === $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
            //var_dump($error);exit();
        }
        $this->database_to_file();
        return true;
    }

    /**
     * 删除
     */
    public function del($id)
    {
        if (!$id || !is_int($id)) {
            return false;
        }
        $result = $this->get($id);
        //$result = Config::get($id);
        if (false !== $result) {
            if ($result->delete()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}