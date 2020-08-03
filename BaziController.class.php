<?php
/**
 * Created by PhpStorm.
 * User: zhouchengwu
 * QQ: 81609827
 * Tel: 13590212634
 * Date: 2018/4/11
 * Time: 9:08
 */
namespace Miudrive\Controller;
class BaziController extends CommonController
{
    public $tiangan;
    public $dizhi;
    public $dizhi_CG;
    public $hour;
    public $shengxiao;
    public $nayin;
    public $shishen;
    public $shiershen;
    public $jiuxing;
    public $jz;

    public function _initialize()
    {
        $this->tiangan = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
        $this->dizhi = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
        $this->dizhi_CG = ['癸','癸辛己','甲丙戊','乙','乙戊癸','庚丙戊','丁己','乙丁己','庚壬戊','辛','戊辛丁','壬甲'];//四柱地支藏干
        $this->hour = ['子','丑','丑','寅','寅','卯','卯','辰','辰','巳','巳','午','午','未','未','申','申','酉','酉','戌','戌','亥','亥','子'];
        $this->shengxiao = ['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'];
        $this->nayin = ['海中金','炉中火','大林木','路旁土','剑锋金','山头火','洞下水','城墙土','白腊金','杨柳木','泉中水','屋上土','霹雳火','松柏木','常流水',
            '砂中金','山下火','平地木','壁上土','金箔金','佛灯火','天河水','大驿土','钗钏金','桑松木','大溪水','砂中土','天上火','石榴木','大海水'];
        //日干六神表
        $this->shishen = [
            ['比','劫','食','伤','财','才','杀','官','枭','印'],
            ['劫','比','伤','食','才','财','官','杀','印','枭'],

            ['枭','印','比','劫','食','伤','财','才','杀','官'],
            ['印','枭','劫','比','伤','食','才','财','官','杀'],

            ['杀','官','枭','印','比','劫','食','伤','财','才'],
            ['官','杀','印','枭','劫','比','伤','食','才','财'],

            ['财','才','杀','官','枭','印','比','劫','食','伤'],
            ['才','财','官','杀','印','枭','劫','比','伤','食'],

            ['食','伤','财','才','杀','官','枭','印','比','劫'],
            ['伤','食','才','财','官','杀','印','枭','劫','比']
        ];
        /*$this->shishen = [
            ['比肩(比)','劫财(劫)','食神(食)','伤官(伤)','偏财(财)','正财(才)','七杀(杀)','正官(官)','偏印(枭)','正印(印)'],
            ['劫财(劫)','比肩(比)','伤官(伤)','食神(食)','正财(才)','偏财(财)','正官(官)','七杀(杀)','正印(印)','偏印(枭)'],

            ['偏印(枭)','正印(印)','比肩(比)','劫财(劫)','食神(食)','伤官(伤)','偏财(财)','正财(才)','七杀(杀)','正官(官)'],
            ['正印(印)','偏印(枭)','劫财(劫)','比肩(比)','伤官(伤)','食神(食)','正财(才)','偏财(财)','正官(官)','七杀(杀)'],

            ['七杀(杀)','正官(官)','偏印(枭)','正印(印)','比肩(比)','劫财(劫)','食神(食)','伤官(伤)','偏财(财)','正财(才)'],
            ['正官(官)','七杀(杀)','正印(印)','偏印(枭)','劫财(劫)','比肩(比)','伤官(伤)','食神(食)','正财(才)','偏财(财)'],

            ['偏财(财)','正财(才)','七杀(杀)','正官(官)','偏印(枭)','正印(印)','比肩(比)','劫财(劫)','食神(食)','伤官(伤)'],
            ['正财(才)','偏财(财)','正官(官)','七杀(杀)','正印(印)','偏印(枭)','劫财(劫)','比肩(比)','伤官(伤)','食神(食)'],

            ['食神(食)','伤官(伤)','偏财(财)','正财(才)','七杀(杀)','正官(官)','偏印(枭)','正印(印)','比肩(比)','劫财(劫)'],
            ['伤官(伤)','食神(食)','正财(才)','偏财(财)','正官(官)','七杀(杀)','正印(印)','偏印(枭)','劫财(劫)','比肩(比)']
        ];*/
        //长生十二神即长生、沐浴、冠带、临官、帝旺、衰、病、死、墓、绝、胎、养。
        $this->shiershen = [
            ['沐浴','冠带','临官','帝旺','衰','病','死','墓','绝','胎','养','长生'],
            ['病','衰','帝旺','临官','冠带','沐浴','长生','养','胎','绝','墓','死'],

            ['胎','养','长生','沐浴','冠带','临官','帝旺','衰','病','死','墓','绝'],
            ['绝','墓','死','病','衰','帝旺','临官','冠带','沐浴','长生','养','胎'],

            ['胎','养','长生','沐浴','冠带','临官','帝旺','衰','病','死','墓','绝'],
            ['绝','墓','死','病','衰','帝旺','临官','冠带','沐浴','长生','养','胎'],

            ['死','墓','绝','胎','养','长生','沐浴','冠带','临官','帝旺','衰','病'],
            ['长生','养','胎','绝','墓','死','病','衰','帝旺','临官','冠带','沐浴'],

            ['帝旺','衰','病','死','墓','绝','胎','养','长生','沐浴','冠带','临官'],
            ['临官','冠带','沐浴','长生','养','胎','绝','墓','死','病','衰','帝旺']
        ];
        //九星 土 水 金 太阳 火 计都 太阴 木 罗候
        $this->jiuxing = [
            ['木','罗候','土','水','金','太阳','火','计都','太阴'],
            ['水','计都','火','木','太阴','土','罗候','太阳','金']
        ];
        $this->jz = $this->getJZ();
    }
    
    public function getJZ(){
        $jz = [];
        for ($i=0;$i<60;$i++){
            $jz[] = $this->tiangan[$i%10].$this->dizhi[$i%12];
        }
        return $jz;
    }

    public function index(){
        $jz = $this->jz;//这是真正的甲子轮回
        if (IS_POST){
            $sex = I('post.sex',0);//性别 0男1女
            $year = I('post.year');//公历出生的年 例：1990
            $month = I('post.month');//公历出生的月 例：12
            $day = I('post.day');//公历出生的日 例：17
            $hour = I('post.hour');//公历出生的时 例：19
            $minute= I('post.minute');//公历出生的分 例：00

            $calendar = new CalendarController();
            $c_obj= $calendar->solar2lunar($year,$month,$day);//生肖 例：马
            $new_obj= $calendar->solar2lunar(date('Y',time()),date('m',time()),date('d',time()));//生肖 例：马
            $shengxiao = $c_obj['Animal'];//生肖 例：马
            $birthday_Y = $c_obj['lYear'];//农历出生的年 例：1990
            $birthday_M = $c_obj['lMonth'];//农历出生的月 例：11
            $birthday_D = $c_obj['lDay'];//农历出生的日 例：19
            $yearGZ1 = $c_obj['gzYear'];//农历出生的年干支 例：
            $monthGZ1 = $c_obj['gzMonth'];//农历出生的月干支 例：
            $dayGZ1 = $c_obj['gzDay'];//农历出生的日干支 例：
            $isLeap = $c_obj['isLeap'];//是否闰月
            $isLeap = $isLeap?'闰':'';
            //获取几字算命
            $jizhi_suanmin=$this->jizhi_shuanmin($year,$month,$day,$birthday_Y,$birthday_M,$hour);


            //阳男阴女顺行，阴男阳女逆行
            if (($birthday_Y%2 + $sex) == 1){
                $sort = 2;
            }else{
                $sort = 1;
            }
            $jieqiday = $calendar->getNearJieQi($year,$month,$day,$sort);
            $qiyun_arr = $this->getQiYun($jieqiday, $birthday_M);//[起运岁数，起运字符串]

            $today_obj= $calendar->solar2lunar(date("Y"),date("m"),date("d"));//今天的日干支
            $todayYearGZ1 = $today_obj['gzYear'];
            $todayMonthGZ1 = $today_obj['gzMonth'];
            $todayDayGZ = $today_obj['gzDay'];//今天的日干支
            $todayHourGZ = implode('', $this->getHourGZ(intval(date('H')),$this->ch2arr($todayDayGZ)[0]));
            $todayRiKong = $this->getRiKong($todayDayGZ);
            $kongWang = $this->getRiKong($dayGZ1);

            $yearGZ = $this->ch2arr($yearGZ1);
            $monthGZ = $this->ch2arr($monthGZ1);
            $dayGZ = $this->ch2arr($dayGZ1);
            $hourGZ =  $this->getHourGZ(intval($hour),$dayGZ[0]);

            $sigong = $this->getSiGong($birthday_Y, $sex);
            $nayin = $this->getNaYin($yearGZ);
            $taiyuan = $this->getTaiYuan($monthGZ);
            
            $m_h = [$yearGZ[0],$monthGZ[1],$hourGZ[1]];//年干，月支，时支
            $minggong = $this->getMingGong($m_h);
            $shengong = $this->getShenGong($m_h);

            //起运排年，从月柱下一个起，排八个
            $monthGZ_index = array_search(implode('', $monthGZ), $jz);
            $qiyun_painian = [];
            for ($i=0;$i<8;$i++){
                $painian_offest = ($sort == 2)?($monthGZ_index-$i-1+60)%60:($monthGZ_index+$i+1)%60;
                $qiyun_painian[] = $jz[$painian_offest];
            }
            $painian = [];
            foreach ($qiyun_painian as $pnv){
                $pnv = $this->ch2arr($pnv);
                $painian[0][] = $this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($pnv[0], $this->tiangan)];//十神
                $painian[1][] = $pnv[0];//干
                $painian[2][] = $pnv[1];//支
                $painian[3][] = $this->shiershen[array_search($dayGZ[0], $this->tiangan)][array_search($pnv[1], $this->dizhi)];//十二神
                $painian[4][] = $this->getNaYin($pnv);//纳音
            }
            /******************************************/

            //这是假设条件一
            $qiyun = $qiyun_arr[0];
            $birthday_index = array_search($yearGZ1, $jz);//出生年所在的索引
            $q_index = ($birthday_index+$qiyun-1)%60;//起运年所在的索引
            $q_arr = [];
            for ($i=0;$i<80;$i++){
                $str = $jz[($q_index+$i)%60];
                $str = $this->ch2arr($str);
                $kw = $this->ch2arr($kongWang);
                $flag = $this->isHongSe($kw, $str[1], $yearGZ[1], $monthGZ[1], $hourGZ[1]);
                $str = $flag?$str[0].'<span style="color:red;">'.$str[1].'</span>':implode('', $str);

                $q_arr[] = ($qiyun+$i).$str;
            }
            $qy_arr = array_chunk($q_arr, 10);
            foreach ($qy_arr as $qk=>$qv){
                $qy_arr[$qk] = implode('<br/>', $qv);
            }

            //九星值年 从今年往前排5年，往后排4年，一共排十年
            $j_start = date('Y')-$birthday_Y-4;
            $jiuxing = $j_start<1?1:$j_start;
            $jiuxing_index = ($birthday_index+$jiuxing-1)%60;//起运年所在的索引
            $jiuxing_arr = [];
            for ($i=0;$i<10;$i++){
                $jiuxing_arr[] = $jz[($jiuxing_index+$i)%60];
            }
            $jiuxing_zhinian = [];
            foreach ($jiuxing_arr as $jxk=>$jxv){
                $jxv = $this->ch2arr($jxv);
                $jiuxing_zhinian[0][] = $this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($jxv[0], $this->tiangan)];//十神
                $jiuxing_zhinian[1][] = $jxv[0];//干
                $jiuxing_zhinian[2][] = $jxv[1];//支
                $jiuxing_zhinian[3][] = $jiuxing + $jxk;//岁数
                $jiuxing_zhinian[4][] = $this->getJiuXing($jiuxing + $jxk,$sex);//九星值年
            }
            /******************************************/
            
            $wuxing = $this->getWuXing([$yearGZ[0],$yearGZ[1],$monthGZ[0],$monthGZ[1],$dayGZ[0],$dayGZ[1],$hourGZ[0],$hourGZ[1]]);
            $w = array_diff(['金','木','水','火','土'], $wuxing);
            if ($w){
                $wx_str = '五行缺'.implode('', $w);
            }else{
                $wx_str = '五行不缺';
            }
            /**************/
            $this->getShengKe();
            $bazifenxi = $this->getShenGe($yearGZ[0], $yearGZ[1], $monthGZ[0], $monthGZ[1], $dayGZ[0], $dayGZ[1], $hourGZ[0], $hourGZ[1], $this->ch2arr($kongWang));
            /**************/
            $Year_liuqin = $this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($yearGZ[0], $this->tiangan)];
            $Month_liuqin = $this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($monthGZ[0], $this->tiangan)];
            $Hour_liuqin = $this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($hourGZ[0], $this->tiangan)];
            $calculateLiuqin = $this->calculateLiuqin($yearGZ[0],$monthGZ[0],$dayGZ[0],$hourGZ[0],$bazifenxi,$sex,$Year_liuqin,$Month_liuqin,$Hour_liuqin);
            $num = 8;
            if ($birthday_Y != $c_obj['gzYnum']){
                $num = 10;
            }elseif($birthday_M != $c_obj['gzMnum']){
                $num = 9;
            }

            $data = [
                'birthday'=>"农历：{$birthday_Y}年{$isLeap}{$birthday_M}月{$birthday_D}日{$hour}时{$minute}分",
                'todaysizhu'=>"$todayYearGZ1 $todayMonthGZ1 $todayDayGZ $todayHourGZ <$todayRiKong>",
                'shengxiao'=>$shengxiao,
                'qiyun'=>$jizhi_suanmin.':'.$qiyun_arr[1],
                'sigong'=>$sigong,
                'num'=>$num,

                'nayin'=>$nayin,
                'taiyuan'=>$taiyuan,
                'minggong'=>$minggong,
                'shengong'=>$shengong,
                'wuxing'=>$wx_str,
                
                'yearGZ'=>$yearGZ,
                'monthGZ'=>$monthGZ,
                'dayGZ'=>$dayGZ,
                'hourGZ'=>$hourGZ,
                'dayRK'=>$kongWang,
                'bazifenxi'=>$bazifenxi,

                'bazinayin'=>[
                    $this->getNaYin($yearGZ),
                    $this->getNaYin($monthGZ),
                    $this->getNaYin($dayGZ),
                    $this->getNaYin($hourGZ),
                ],

                'dizhi_CG'=>[
                    $this->dizhi_CG[array_search($yearGZ[1], $this->dizhi)],
                    $this->dizhi_CG[array_search($monthGZ[1], $this->dizhi)],
                    $this->dizhi_CG[array_search($dayGZ[1], $this->dizhi)],
                    $this->dizhi_CG[array_search($hourGZ[1], $this->dizhi)]
                ],

                'sizhu_10shen'=>[
                    $calculateLiuqin[0].'<br/>'.$this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($yearGZ[0], $this->tiangan)],
                    $calculateLiuqin[1].'<br/>'.$this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($monthGZ[0], $this->tiangan)],
                    '<br/><日元>',
                    $calculateLiuqin[2].'<br/>'.$this->shishen[array_search($dayGZ[0], $this->tiangan)][array_search($hourGZ[0], $this->tiangan)]
                ],

                'sizhu_12shen'=>[
                    $this->shiershen[array_search($dayGZ[0], $this->tiangan)][array_search($yearGZ[1], $this->dizhi)],
                    $this->shiershen[array_search($dayGZ[0], $this->tiangan)][array_search($monthGZ[1], $this->dizhi)],
                    $this->shiershen[array_search($dayGZ[0], $this->tiangan)][array_search($dayGZ[1], $this->dizhi)],
                    $this->shiershen[array_search($dayGZ[0], $this->tiangan)][array_search($hourGZ[1], $this->dizhi)]
                ],

                'qiyun_num'=>[$qiyun,$qiyun+10,$qiyun+20,$qiyun+30,$qiyun+40,$qiyun+50,$qiyun+60,$qiyun+70],
                'qiyun_year'=>[$birthday_Y-1+$qiyun,$birthday_Y-1+$qiyun+10,$birthday_Y-1+$qiyun+20,$birthday_Y-1+$qiyun+30,$birthday_Y-1+$qiyun+40,$birthday_Y-1+$qiyun+50,$birthday_Y-1+$qiyun+60,$birthday_Y-1+$qiyun+70],
                'q_arr'=>$qy_arr,
                'painian'=>$painian,
                'jiuxing'=>$jiuxing_zhinian,
                'calculateLiuqin'=>$calculateLiuqin,
                 'jizhisuanmin'=>$jizhi_suanmin,
                'test'=>[$yearGZ[0], $yearGZ[1], $monthGZ[0], $monthGZ[1], $dayGZ[0], $dayGZ[1], $hourGZ[0], $hourGZ[1], $this->ch2arr($kongWang)]

            ];
            $this->ajax(1,'success',$data);exit;
        }

        $this->display();
    }

    public function ch2arr($str){
        $length = mb_strlen($str, 'utf-8');
        $array = [];
        for ($i=0; $i<$length; $i++)
            $array[] = mb_substr($str, $i, 1, 'utf-8');
        return $array;
    }

    //计算日空亡，输入参数为日干
    public function getRiKong($dayGZ){
        $arr = ['戌亥','申酉','午未','辰巳','寅卯','子丑'];
        $index = floor(array_search($dayGZ,$this->jz)/10);
        return $arr[$index];
    }

    public function getSiGong($year,$sex){
        $sex = !$sex;
        $gong = array("离", "坎", "坤", "震", "巽", "中", "乾", "兑", "艮");
        $text = "";
        $num = 0;
        if ($sex){//男
            if ($year >= 1900 && $year <= 1999)
            {
                $num = (2000 - $year) % 9;
            }
            else if ($year >= 2000 && $year <= 2099)
            {
                $num = (2099 - $year) % 9;
            }
        }else {//女
            if ($year >= 1900 && $year <= 1999)
            {
                $num = ($year - 1900 + 5) % 9;
            }
            else if ($year >= 2000 && $year <= 2099)
            {
                $num = ($year - 2000 + 6) % 9;
            }
        }
        if ($num == 5)
        {
            $num = ($sex ? ($num - 3) : ($num + 3));
        }
        switch ($num)
        {
            case 0:
            case 1:
            case 3:
            case 4:
                $text = "东四宫";
                break;
            case 2:
            case 6:
            case 7:
            case 8:
                $text = "西四宫";
                break;
        }
        return $text.'之'.$gong[$num].'宫';
    }

    public function getWuXing($bazi){
        //甲-木、乙-木、丙-火、丁－火、戊－土、己－土、庚－金、辛－金、壬－水、癸－水
        //子-水、丑-土、寅-木、卯－木、辰－土、巳－火、午－火、未－土、申－金、酉－金、戌－土、亥－水
        //金：庚辛申酉 木：甲乙寅卯 水：壬癸子亥 火：丙丁巳午 土：戊己丑辰未戌
        $arr = [
            ['庚','辛','申','酉'],
            ['甲','乙','寅','卯'],
            ['壬','癸','子','亥'],
            ['丙','丁','巳','午'],
            ['戊','己','丑','辰','未','戌']
        ];
        $wuxing = [];
        foreach ($arr as $k=>$v){
            $s = array_intersect($bazi,$v);
            if (count($s)>0){
                switch ($k){
                    case 0:
                        array_push($wuxing, '金');
                        break;
                    case 1:
                        array_push($wuxing, '木');
                        break;
                    case 2:
                        array_push($wuxing, '水');
                        break;
                    case 3:
                        array_push($wuxing, '火');
                        break;
                    case 4:
                        array_push($wuxing, '土');
                        break;
                }
            }
        }
        return $wuxing;
    }

    /* *
     * 命宫计算
     * @param [年干，月支，时支]
     * */
    public function getMingGong($gz){
        $monthZ_num = array_search($gz[1], $this->dizhi);
        $hourZ_num = array_search($gz[2], $this->dizhi);
        $monthZ_num = ($monthZ_num+10)%12+1;
        $hourZ_num = ($hourZ_num+10)%12+1;
        $num = $monthZ_num+$hourZ_num;
        $num = $num>14?26-$num:14-$num;
        $num = ($num+11)%12;
        $str = ['寅','卯','辰','巳','午','未','申','酉','戌','亥','子','丑',];
        $m_z = $str[$num];//命宫支

        $c = array_search($gz[0], $this->tiangan);
        $d = array_search($m_z, $this->dizhi);
//        $d = ($d<2)?$d+2:$d;
        $e = ($c%5*2+$d)%10;
        $m_g = $this->tiangan[$e];//命宫干
        return $m_g.$m_z;
    }

    /* *
     * 身宫计算
     * @param [年干，月支，时支]
     * */
    public function getShenGong($gz){
        $monthZ_num = array_search($gz[1], $this->dizhi);
        $hourZ_num = array_search($gz[2], $this->dizhi);
        $monthZ_num = ($monthZ_num+10)%12+1;
        $hourZ_num = ($hourZ_num+10)%12+1;
        $num = $monthZ_num+$hourZ_num;
        $num = ($num + 1) % 12;
        $str = ['寅','卯','辰','巳','午','未','申','酉','戌','亥','子','丑',];
        $s_z = $str[$num];//身宫支

        $c = array_search($gz[0], $this->tiangan);
        $d = array_search($s_z, $this->dizhi);
        $e = ($c%5*2+$d)%10;
        $s_g = $this->tiangan[$e];//身宫干
        return $s_g.$s_z;
    }

    /* *
     * 胎元计算 这是一个很简单的算法，输入参数为月柱
     * @param [干，支]
     * */
    public function getTaiYuan($gz){
        $a = array_search($gz[0], $this->tiangan)+1;
        $b = array_search($gz[1], $this->dizhi)+3;
        return $this->tiangan[$a%10].$this->dizhi[$b%12];
    }

    /* *
     * 纳音计算 这是一个相对复杂的算法，先通过干支计算甲子轮回中的排序，再匹配对应的纳音
     * @param [干，支]
     * */
    public function getNaYin($gz){
        $a = array_search($gz[0], $this->tiangan);
        $b = array_search($gz[1], $this->dizhi);
        if ($a >= $b){
            $c = ($a-$b)/2;
        }else{
            $c = ($a+10-$b)/2+1;
        }
        return $this->nayin[floor(($c*10+$a)/2)];
    }

    /**
     * 日的干支计算
     * 输入参数为公历的年月日
     * */
    public function getDayGZ($year,$M,$d){
        if ($M<3){
            $M += 12;
            $year -= 1;
        }
        $C = floor($year/100);
        $y = $year%100;

        $i = ($M%2 == 0)?6:0;
        $G = $C*4 + floor($C/4) + 5*$y + floor($y/4) + floor(3*($M+1)/5) + $d - 3;
        $Z = $C*8 + floor($C/4) + 5*$y + floor($y/4) + floor(3*($M+1)/5) + $d + 7 + $i;

        return [$this->tiangan[($G-1)%10],$this->dizhi[($Z-1)%12]];
    }

    /* *
     * 时的干支计算 日上起时法
     * @param $hour 时支
     * @param $dayG 日干
     * return [干，支]
     * */
    public function getHourGZ($hour,$dayG){
        $h_dizhi =  $this->hour[intval($hour)];
        $b = array_search($dayG, $this->tiangan);
        $c = array_search($h_dizhi, $this->dizhi);
        $h_tiangan = $this->tiangan[($b%5*2+$c)%10];
        return [$h_tiangan,$h_dizhi];
    }

    //九星值年
    public function getJiuXing($age,$sex){
        return $this->jiuxing[$sex][$age%9];
    }

    //起运
    public function getQiYun($num,$month){
        $num2 = floor($num / 3);
        $num3 = $num % 3 * 4 + $month;
        if ($num3 >= 13){
            $num2++;
            $num3 -= 12;
        }
        if ($num2 == 0){
            $num2++;
            $text = $num2."岁行运";
        }else{
            $text = $num2."岁".$num3."月行运";
        }
        return [$num2,$text];
    }

    //关于生克
    public function getShengKe(){
        $this->RS_NO = 0;
		$this->RS_BL_H = 1;
		$this->RS_BL_L = 2;
		$this->RS_SL_H = 3;
		$this->RS_SL_L = 4;
		$this->RS_KL_H = 5;
		$this->RS_KL_L = 6;
		$this->RS_XL_H = 7;
		$this->RS_XL_L = 8;
		$this->RS_HL_H = 9;
		$this->RS_HL_L = 10;
		$this->RS_CL_H = 11;
		$this->RS_CL_L = 12;
		$this->RS_XGL_H = 13;
		$this->RS_XGL_L = 14;
        $rstt[0][0] = $this->RS_BL_H;
        $rstt[0][1] = $this->RS_BL_L;
        $rstt[0][2] = $this->RS_SL_H;
        $rstt[0][3] = $this->RS_SL_L;
        $rstt[0][4] = $this->RS_KL_H;
        $rstt[0][5] = $this->RS_KL_L;
        $rstt[0][6] = $this->RS_XL_H;
        $rstt[0][7] = $this->RS_XL_L;
        $rstt[0][8] = $this->RS_HL_H;
        $rstt[0][9] = $this->RS_HL_L;
        $rstt[1][0] = $this->RS_BL_L;
        $rstt[1][1] = $this->RS_BL_H;
        $rstt[1][2] = $this->RS_SL_L;
        $rstt[1][3] = $this->RS_SL_H;
        $rstt[1][4] = $this->RS_KL_L;
        $rstt[1][5] = $this->RS_KL_H;
        $rstt[1][6] = $this->RS_XL_L;
        $rstt[1][7] = $this->RS_XL_H;
        $rstt[1][8] = $this->RS_HL_L;
        $rstt[1][9] = $this->RS_HL_H;
        $rstt[2][0] = $this->RS_HL_H;
        $rstt[2][1] = $this->RS_HL_L;
        $rstt[2][2] = $this->RS_BL_H;
        $rstt[2][3] = $this->RS_BL_L;
        $rstt[2][4] = $this->RS_SL_H;
        $rstt[2][5] = $this->RS_SL_L;
        $rstt[2][6] = $this->RS_KL_H;
        $rstt[2][7] = $this->RS_KL_L;
        $rstt[2][8] = $this->RS_XL_H;
        $rstt[2][9] = $this->RS_XL_L;
        $rstt[3][0] = $this->RS_HL_L;
        $rstt[3][1] = $this->RS_HL_H;
        $rstt[3][2] = $this->RS_BL_L;
        $rstt[3][3] = $this->RS_BL_H;
        $rstt[3][4] = $this->RS_SL_L;
        $rstt[3][5] = $this->RS_SL_H;
        $rstt[3][6] = $this->RS_KL_L;
        $rstt[3][7] = $this->RS_KL_H;
        $rstt[3][8] = $this->RS_XL_L;
        $rstt[3][9] = $this->RS_XL_H;
        $rstt[4][0] = $this->RS_XL_H;
        $rstt[4][1] = $this->RS_XL_L;
        $rstt[4][2] = $this->RS_HL_H;
        $rstt[4][3] = $this->RS_HL_L;
        $rstt[4][4] = $this->RS_BL_H;
        $rstt[4][5] = $this->RS_BL_L;
        $rstt[4][6] = $this->RS_SL_H;
        $rstt[4][7] = $this->RS_SL_L;
        $rstt[4][8] = $this->RS_KL_H;
        $rstt[4][9] = $this->RS_KL_L;
        $rstt[5][0] = $this->RS_XL_L;
        $rstt[5][1] = $this->RS_XL_H;
        $rstt[5][2] = $this->RS_HL_L;
        $rstt[5][3] = $this->RS_HL_H;
        $rstt[5][4] = $this->RS_BL_L;
        $rstt[5][5] = $this->RS_BL_H;
        $rstt[5][6] = $this->RS_SL_L;
        $rstt[5][7] = $this->RS_SL_H;
        $rstt[5][8] = $this->RS_KL_L;
        $rstt[5][9] = $this->RS_KL_H;
        $rstt[6][0] = $this->RS_KL_H;
        $rstt[6][1] = $this->RS_KL_L;
        $rstt[6][2] = $this->RS_XL_H;
        $rstt[6][3] = $this->RS_XL_L;
        $rstt[6][4] = $this->RS_HL_H;
        $rstt[6][5] = $this->RS_HL_L;
        $rstt[6][6] = $this->RS_BL_H;
        $rstt[6][7] = $this->RS_BL_L;
        $rstt[6][8] = $this->RS_SL_H;
        $rstt[6][9] = $this->RS_SL_L;
        $rstt[7][0] = $this->RS_KL_L;
        $rstt[7][1] = $this->RS_KL_H;
        $rstt[7][2] = $this->RS_XL_L;
        $rstt[7][3] = $this->RS_XL_H;
        $rstt[7][4] = $this->RS_HL_L;
        $rstt[7][5] = $this->RS_HL_H;
        $rstt[7][6] = $this->RS_BL_L;
        $rstt[7][7] = $this->RS_BL_H;
        $rstt[7][8] = $this->RS_SL_L;
        $rstt[7][9] = $this->RS_SL_H;
        $rstt[8][0] = $this->RS_SL_H;
        $rstt[8][1] = $this->RS_SL_L;
        $rstt[8][2] = $this->RS_KL_H;
        $rstt[8][3] = $this->RS_KL_L;
        $rstt[8][4] = $this->RS_XL_H;
        $rstt[8][5] = $this->RS_XL_L;
        $rstt[8][6] = $this->RS_HL_H;
        $rstt[8][7] = $this->RS_HL_L;
        $rstt[8][8] = $this->RS_BL_H;
        $rstt[8][9] = $this->RS_BL_L;
        $rstt[9][0] = $this->RS_SL_L;
        $rstt[9][1] = $this->RS_SL_H;
        $rstt[9][2] = $this->RS_KL_L;
        $rstt[9][3] = $this->RS_KL_H;
        $rstt[9][4] = $this->RS_XL_L;
        $rstt[9][5] = $this->RS_XL_H;
        $rstt[9][6] = $this->RS_HL_L;
        $rstt[9][7] = $this->RS_HL_H;
        $rstt[9][8] = $this->RS_BL_L;
        $rstt[9][9] = $this->RS_BL_H;
        $this->RS_TT = $rstt;
        $rsdt[0][0] = $this->RS_SL_H;
        $rsdt[0][1] = $this->RS_SL_L;
        $rsdt[0][2] = $this->RS_KL_H;
        $rsdt[0][3] = $this->RS_KL_L;
        $rsdt[0][4] = $this->RS_XL_H;
        $rsdt[0][5] = $this->RS_XL_L;
        $rsdt[0][6] = $this->RS_HL_H;
        $rsdt[0][7] = $this->RS_HL_L;
        $rsdt[0][8] = $this->RS_BL_H;
        $rsdt[0][9] = $this->RS_BL_L;
        $rsdt[1][0] = $this->RS_XL_L;
        $rsdt[1][1] = $this->RS_XL_H;
        $rsdt[1][2] = $this->RS_HL_L;
        $rsdt[1][3] = $this->RS_HL_H;
        $rsdt[1][4] = $this->RS_BL_L;
        $rsdt[1][5] = $this->RS_BL_H;
        $rsdt[1][6] = $this->RS_BL_L;
        $rsdt[1][7] = $this->RS_SL_H;
        $rsdt[1][8] = $this->RS_KL_L;
        $rsdt[1][9] = $this->RS_SL_H;
        $rsdt[2][0] = $this->RS_BL_H;
        $rsdt[2][1] = $this->RS_BL_L;
        $rsdt[2][2] = $this->RS_SL_H;
        $rsdt[2][3] = $this->RS_SL_L;
        $rsdt[2][4] = $this->RS_KL_H;
        $rsdt[2][5] = $this->RS_KL_L;
        $rsdt[2][6] = $this->RS_XL_H;
        $rsdt[2][7] = $this->RS_XL_L;
        $rsdt[2][8] = $this->RS_HL_H;
        $rsdt[2][9] = $this->RS_HL_L;
        $rsdt[3][0] = $this->RS_BL_L;
        $rsdt[3][1] = $this->RS_BL_H;
        $rsdt[3][2] = $this->RS_SL_L;
        $rsdt[3][3] = $this->RS_SL_H;
        $rsdt[3][4] = $this->RS_KL_L;
        $rsdt[3][5] = $this->RS_KL_H;
        $rsdt[3][6] = $this->RS_XL_L;
        $rsdt[3][7] = $this->RS_XL_H;
        $rsdt[3][8] = $this->RS_HL_L;
        $rsdt[3][9] = $this->RS_HL_H;
        $rsdt[4][0] = $this->RS_XL_H;
        $rsdt[4][1] = $this->RS_XL_L;
        $rsdt[4][2] = $this->RS_HL_H;
        $rsdt[4][3] = $this->RS_HL_L;
        $rsdt[4][4] = $this->RS_BL_H;
        $rsdt[4][5] = $this->RS_BL_L;
        $rsdt[4][6] = $this->RS_BL_H;
        $rsdt[4][7] = $this->RS_BL_L;
        $rsdt[4][8] = $this->RS_BL_H;
        $rsdt[4][9] = $this->RS_KL_L;
        $rsdt[5][0] = $this->RS_HL_L;
        $rsdt[5][1] = $this->RS_HL_H;
        $rsdt[5][2] = $this->RS_BL_L;
        $rsdt[5][3] = $this->RS_BL_H;
        $rsdt[5][4] = $this->RS_SL_L;
        $rsdt[5][5] = $this->RS_SL_H;
        $rsdt[5][6] = $this->RS_KL_L;
        $rsdt[5][7] = $this->RS_KL_H;
        $rsdt[5][8] = $this->RS_XL_L;
        $rsdt[5][9] = $this->RS_XL_H;
        $rsdt[6][0] = $this->RS_HL_H;
        $rsdt[6][1] = $this->RS_HL_L;
        $rsdt[6][2] = $this->RS_BL_H;
        $rsdt[6][3] = $this->RS_BL_L;
        $rsdt[6][4] = $this->RS_SL_H;
        $rsdt[6][5] = $this->RS_SL_L;
        $rsdt[6][6] = $this->RS_KL_H;
        $rsdt[6][7] = $this->RS_KL_L;
        $rsdt[6][8] = $this->RS_XL_H;
        $rsdt[6][9] = $this->RS_XL_L;
        $rsdt[7][0] = $this->RS_XL_L;
        $rsdt[7][1] = $this->RS_XL_H;
        $rsdt[7][2] = $this->RS_HL_L;
        $rsdt[7][3] = $this->RS_BL_H;
        $rsdt[7][4] = $this->RS_BL_L;
        $rsdt[7][5] = $this->RS_BL_H;
        $rsdt[7][6] = $this->RS_KL_L;
        $rsdt[7][7] = $this->RS_KL_H;
        $rsdt[7][8] = $this->RS_KL_L;
        $rsdt[7][9] = $this->RS_KL_H;
        $rsdt[8][0] = $this->RS_KL_H;
        $rsdt[8][1] = $this->RS_KL_L;
        $rsdt[8][2] = $this->RS_XL_H;
        $rsdt[8][3] = $this->RS_XL_L;
        $rsdt[8][4] = $this->RS_HL_H;
        $rsdt[8][5] = $this->RS_HL_L;
        $rsdt[8][6] = $this->RS_BL_H;
        $rsdt[8][7] = $this->RS_BL_L;
        $rsdt[8][8] = $this->RS_SL_H;
        $rsdt[8][9] = $this->RS_SL_L;
        $rsdt[9][0] = $this->RS_KL_L;
        $rsdt[9][1] = $this->RS_KL_H;
        $rsdt[9][2] = $this->RS_XL_L;
        $rsdt[9][3] = $this->RS_XL_H;
        $rsdt[9][4] = $this->RS_HL_L;
        $rsdt[9][5] = $this->RS_HL_H;
        $rsdt[9][6] = $this->RS_BL_L;
        $rsdt[9][7] = $this->RS_BL_H;
        $rsdt[9][8] = $this->RS_SL_L;
        $rsdt[9][9] = $this->RS_SL_H;
        $rsdt[10][0] = $this->RS_XL_H;
        $rsdt[10][1] = $this->RS_XL_L;
        $rsdt[10][2] = $this->RS_BL_H;
        $rsdt[10][3] = $this->RS_HL_L;
        $rsdt[10][4] = $this->RS_BL_H;
        $rsdt[10][5] = $this->RS_BL_L;
        $rsdt[10][6] = $this->RS_KL_H;
        $rsdt[10][7] = $this->RS_KL_L;
        $rsdt[10][8] = $this->RS_KL_H;
        $rsdt[10][9] = $this->RS_KL_L;
        $rsdt[11][0] = $this->RS_SL_L;
        $rsdt[11][1] = $this->RS_SL_H;
        $rsdt[11][2] = $this->RS_KL_L;
        $rsdt[11][3] = $this->RS_KL_H;
        $rsdt[11][4] = $this->RS_XL_L;
        $rsdt[11][5] = $this->RS_XL_H;
        $rsdt[11][6] = $this->RS_HL_L;
        $rsdt[11][7] = $this->RS_HL_H;
        $rsdt[11][8] = $this->RS_BL_L;
        $rsdt[11][9] = $this->RS_BL_H;
        $this->RS_DT = $rsdt;
        $rsdd[0][0] = $this->RS_BL_H;
        $rsdd[0][1] = $this->RS_NO;
        $rsdd[0][2] = $this->RS_SL_H;
        $rsdd[0][3] = $this->RS_SL_L;
        $rsdd[0][4] = $this->RS_NO;
        $rsdd[0][5] = $this->RS_KL_L;
        $rsdd[0][6] = $this->RS_CL_H;
        $rsdd[0][7] = $this->RS_XL_L;
        $rsdd[0][8] = $this->RS_HL_H;
        $rsdd[0][9] = $this->RS_HL_L;
        $rsdd[0][10] = $this->RS_XL_H;
        $rsdd[0][11] = $this->RS_BL_L;
        $rsdd[1][0] = $this->RS_NO;
        $rsdd[1][1] = $this->RS_BL_H;
        $rsdd[1][2] = $this->RS_XL_L;
        $rsdd[1][3] = $this->RS_XL_H;
        $rsdd[1][4] = $this->RS_BL_L;
        $rsdd[1][5] = $this->RS_HL_H;
        $rsdd[1][6] = $this->RS_HL_L;
        $rsdd[1][7] = $this->RS_CL_H;
        $rsdd[1][8] = $this->RS_SL_L;
        $rsdd[1][9] = $this->RS_SL_H;
        $rsdd[1][10] = $this->RS_XGL_H;
        $rsdd[1][11] = $this->RS_NO;
        $rsdd[2][0] = $this->RS_HL_H;
        $rsdd[2][1] = $this->RS_KL_L;
        $rsdd[2][2] = $this->RS_BL_H;
        $rsdd[2][3] = $this->RS_BL_L;
        $rsdd[2][4] = $this->RS_KL_H;
        $rsdd[2][5] = $this->RS_SL_L;
        $rsdd[2][6] = $this->RS_SL_H;
        $rsdd[2][7] = $this->RS_KL_L;
        $rsdd[2][8] = $this->RS_CL_H;
        $rsdd[2][9] = $this->RS_XL_L;
        $rsdd[2][10] = $this->RS_KL_H;
        $rsdd[2][11] = $this->RS_HL_L;
        $rsdd[3][0] = $this->RS_HL_L;
        $rsdd[3][1] = $this->RS_KL_H;
        $rsdd[3][2] = $this->RS_BL_L;
        $rsdd[3][3] = $this->RS_BL_H;
        $rsdd[3][4] = $this->RS_KL_L;
        $rsdd[3][5] = $this->RS_SL_H;
        $rsdd[3][6] = $this->RS_SL_L;
        $rsdd[3][7] = $this->RS_KL_H;
        $rsdd[3][8] = $this->RS_XL_L;
        $rsdd[3][9] = $this->RS_CL_H;
        $rsdd[3][10] = $this->RS_KL_L;
        $rsdd[3][11] = $this->RS_HL_H;
        $rsdd[4][0] = $this->RS_NO;
        $rsdd[4][1] = $this->RS_BL_L;
        $rsdd[4][2] = $this->RS_XL_H;
        $rsdd[4][3] = $this->RS_XL_L;
        $rsdd[4][4] = $this->RS_BL_H;
        $rsdd[4][5] = $this->RS_HL_L;
        $rsdd[4][6] = $this->RS_HL_H;
        $rsdd[4][7] = $this->RS_BL_L;
        $rsdd[4][8] = $this->RS_SL_H;
        $rsdd[4][9] = $this->RS_SL_L;
        $rsdd[4][10] = $this->RS_CL_H;
        $rsdd[4][11] = $this->RS_NO;
        $rsdd[5][0] = $this->RS_XL_L;
        $rsdd[5][1] = $this->RS_SL_H;
        $rsdd[5][2] = $this->RS_HL_L;
        $rsdd[5][3] = $this->RS_HL_H;
        $rsdd[5][4] = $this->RS_SL_L;
        $rsdd[5][5] = $this->RS_BL_H;
        $rsdd[5][6] = $this->RS_BL_L;
        $rsdd[5][7] = $this->RS_SL_H;
        $rsdd[5][8] = $this->RS_KL_L;
        $rsdd[5][9] = $this->RS_KL_H;
        $rsdd[5][10] = $this->RS_SL_L;
        $rsdd[5][11] = $this->RS_CL_H;
        $rsdd[6][0] = $this->RS_CL_H;
        $rsdd[6][1] = $this->RS_SL_L;
        $rsdd[6][2] = $this->RS_HL_H;
        $rsdd[6][3] = $this->RS_HL_L;
        $rsdd[6][4] = $this->RS_SL_H;
        $rsdd[6][5] = $this->RS_BL_L;
        $rsdd[6][6] = $this->RS_BL_H;
        $rsdd[6][7] = $this->RS_SL_L;
        $rsdd[6][8] = $this->RS_KL_H;
        $rsdd[6][9] = $this->RS_KL_L;
        $rsdd[6][10] = $this->RS_SL_H;
        $rsdd[6][11] = $this->RS_XL_L;
        $rsdd[7][0] = $this->RS_KL_L;
        $rsdd[7][1] = $this->RS_CL_H;
        $rsdd[7][2] = $this->RS_XL_L;
        $rsdd[7][3] = $this->RS_XL_H;
        $rsdd[7][4] = $this->RS_BL_L;
        $rsdd[7][5] = $this->RS_NO;
        $rsdd[7][6] = $this->RS_NO;
        $rsdd[7][7] = $this->RS_BL_H;
        $rsdd[7][8] = $this->RS_KL_L;
        $rsdd[7][9] = $this->RS_KL_H;
        $rsdd[7][10] = $this->RS_BL_L;
        $rsdd[7][11] = $this->RS_KL_H;
        $rsdd[8][0] = $this->RS_SL_H;
        $rsdd[8][1] = $this->RS_HL_L;
        $rsdd[8][2] = $this->RS_CL_H;
        $rsdd[8][3] = $this->RS_KL_L;
        $rsdd[8][4] = $this->RS_HL_H;
        $rsdd[8][5] = $this->RS_XL_L;
        $rsdd[8][6] = $this->RS_XL_H;
        $rsdd[8][7] = $this->RS_XL_L;
        $rsdd[8][8] = $this->RS_BL_H;
        $rsdd[8][9] = $this->RS_BL_L;
        $rsdd[8][10] = $this->RS_XL_H;
        $rsdd[8][11] = $this->RS_SL_L;
        $rsdd[9][0] = $this->RS_SL_L;
        $rsdd[9][1] = $this->RS_HL_H;
        $rsdd[9][2] = $this->RS_KL_L;
        $rsdd[9][3] = $this->RS_CL_H;
        $rsdd[9][4] = $this->RS_HL_L;
        $rsdd[9][5] = $this->RS_XL_H;
        $rsdd[9][6] = $this->RS_XL_L;
        $rsdd[9][7] = $this->RS_XL_H;
        $rsdd[9][8] = $this->RS_BL_L;
        $rsdd[9][9] = $this->RS_BL_H;
        $rsdd[9][10] = $this->RS_XL_L;
        $rsdd[9][11] = $this->RS_SL_H;
        $rsdd[10][0] = $this->RS_KL_H;
        $rsdd[10][1] = $this->RS_XGL_H;
        $rsdd[10][2] = $this->RS_XL_H;
        $rsdd[10][3] = $this->RS_XL_L;
        $rsdd[10][4] = $this->RS_CL_H;
        $rsdd[10][5] = $this->RS_NO;
        $rsdd[10][6] = $this->RS_NO;
        $rsdd[10][7] = $this->RS_BL_L;
        $rsdd[10][8] = $this->RS_KL_H;
        $rsdd[10][9] = $this->RS_KL_L;
        $rsdd[10][10] = $this->RS_BL_H;
        $rsdd[10][11] = $this->RS_KL_L;
        $rsdd[11][0] = $this->RS_BL_L;
        $rsdd[11][1] = $this->RS_XL_H;
        $rsdd[11][2] = $this->RS_SL_L;
        $rsdd[11][3] = $this->RS_SL_H;
        $rsdd[11][4] = $this->RS_XL_L;
        $rsdd[11][5] = $this->RS_CL_H;
        $rsdd[11][6] = $this->RS_KL_L;
        $rsdd[11][7] = $this->RS_XL_H;
        $rsdd[11][8] = $this->RS_HL_L;
        $rsdd[11][9] = $this->RS_HL_H;
        $rsdd[11][10] = $this->RS_XL_L;
        $rsdd[11][11] = $this->RS_BL_H;
        $this->RS_DD = $rsdd;
    }

    public function getRstt($tianan1, $tianan2){ return $this->RS_TT[$tianan1][$tianan2];}

    public function getRsdd($deqi1, $deqi2){ return $this->RS_DD[$deqi1][$deqi2];}

    public function getRsdt($deqi, $tianan){ return $this->RS_DT[$deqi][$tianan];}

    public function isBangli($rs){ return $this->RS_BL_H == $rs || $this->RS_BL_L == $rs;}

    public function isShengli($rs){ return $this->RS_SL_H == $rs || $this->RS_SL_L == $rs;}

    public function isChongli($rs){ return $this->RS_CL_H == $rs || $this->RS_CL_L == $rs;}

    public function isXieli($rs){ return $this->RS_XL_H == $rs || $this->RS_XL_L == $rs;}

    public function isHaoli($rs){ return $this->RS_HL_H == $rs || $this->RS_HL_L == $rs;}

    public function isKeli($rs){ return $this->RS_KL_H == $rs || $this->RS_KL_L == $rs;}

    public function isXingli($rs){ return $this->RS_XGL_H == $rs || $this->RS_XGL_L == $rs;}

    public function isNoli($rs){ return $this->RS_NO == $rs;}

    public function isStrongCForKongwang($YearG,$MonthG){
        $rstt = $this->getRstt(array_search($YearG, $this->tiangan), array_search($MonthG, $this->tiangan));
        return $this->isBangli($rstt) || $this->isShengli($rstt);
    }

    public function isStrongFForKongwang($YearZ,$DayZ,$HourZ,$KongWang){
        if ($KongWang != null && in_array($HourZ, $KongWang)){ return true;}
        $deqi = array_search($YearZ, $this->dizhi);
        $deqi2 = array_search($DayZ, $this->dizhi);
        $deqiHour = array_search($HourZ, $this->dizhi);
        $rsdd = $this->getRsdd($deqi, $deqi2);
        $rsdd2 = $this->getRsdd($deqiHour, $deqi2);
        return ((!$this->isChongli($rsdd) && !$this->isKeli($rsdd) && !$this->isHaoli($rsdd) && !$this->isXingli($rsdd)) || (!$this->isChongli($rsdd2) && !$this->isKeli($rsdd2) && !$this->isHaoli($rsdd2) && !$this->isXingli($rsdd2))) && ($this->isBangli($rsdd) || $this->isShengli($rsdd) || $this->isBangli($rsdd2) || $this->isShengli($rsdd2) || $this->isXieli($rsdd) || $this->isNoli($rsdd) || $this->isXieli($rsdd2) || $this->isNoli($rsdd2));
    }

    public function isStrongGForKongwang($HourG,$HourZ,$KongWang){
        if ($KongWang != null && in_array($HourZ, $KongWang)){ return false;}
        $tiananHour = array_search($HourG, $this->tiangan);
        $deqiHour = array_search($HourZ, $this->dizhi);
        $rsdt = $this->getRsdt($deqiHour, $tiananHour);
        return $this->isBangli($rsdt) || $this->isShengli($rsdt);
    }

    public function isStrongCForNotKongwang($YearG,$YearZ,$MonthG,$MonthZ,$DayG,$DayZ,$HourZ,$isUsedInput, $isBangSengLiDE){
        $tianan = array_search($YearG, $this->tiangan);
        $tianan2 = array_search($MonthG, $this->tiangan);
        $deqi = array_search($MonthZ, $this->dizhi);
        $rstt = $this->getRstt($tianan, $tianan2);
        $rsdt = $this->getRsdt($deqi, $tianan2);
        return $this->isBangli($rstt) || $this->isShengli($rstt) || (($this->isBangli($rsdt) || $this->isShengli($rsdt)) && !$this->isDThreeZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$isUsedInput, $isBangSengLiDE));
    }

    public function isStrongFForNotKongwang($MonthZ,$DayZ,$HourZ,$KongWang){
        if ($KongWang != null && in_array($HourZ, $KongWang)){ return true;}
        $deqi = array_search($MonthZ, $this->dizhi);
        $deqiHour = array_search($HourZ, $this->dizhi);
        $deqi2 = array_search($DayZ, $this->dizhi);
        $rsdd = $this->getRsdd($deqi, $deqi2);
        $rsdd2 = $this->getRsdd($deqiHour, $deqi2);
        return (!$this->isChongli($rsdd) && !$this->isKeli($rsdd) && !$this->isHaoli($rsdd) && !$this->isXingli($rsdd)) || (!$this->isChongli($rsdd2) && !$this->isKeli($rsdd2) && !$this->isHaoli($rsdd2) && !$this->isXingli($rsdd2));
    }

    public function isStrongGForNotKongwang($HourG,$HourZ,$KongWang){ return $this->isStrongGForKongwang($HourG,$HourZ,$KongWang);}

    public function isDTwoZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$KongWang,$isUsedInput, $isBangSengLiDE){
        $deqi = array_search($YearZ, $this->dizhi);
        $deqi2 = array_search($MonthZ, $this->dizhi);
        $tianan = array_search($DayG, $this->tiangan);
        $deqi3 = array_search($DayZ, $this->dizhi);
        $deqiHour = array_search($HourZ, $this->dizhi);
        $rsdt = $this->getRsdt($deqi2, $tianan);
        $rsdd = $this->getRsdd($deqi, $deqi2);
        $rsdd2 = $this->getRsdd($deqi3, $deqi2);
        $rsdd3 = $this->getRsdd($deqiHour, $deqi3);
        $rsdt2 = $this->getRsdt($deqi, $tianan);
        $rsdt3 = $this->getRsdt($deqi3, $tianan);
        $flag = false;
        if ($KongWang != null && in_array($HourZ, $KongWang)){ $flag = true;}
        if ($isUsedInput){
            $flag2 = $isBangSengLiDE;
        }else{
            $flag2 = ($this->isBangli($rsdt) || $this->isShengli($rsdt));
        }
        if ($flag2){
            if ($this->isKeli($rsdd) || $this->isHaoli($rsdd) || $this->isChongli($rsdd) || $this->isXingli($rsdd)){
                if ($this->isKeli($rsdd2) || $this->isHaoli($rsdd2)){
                    if (((!$this->isBangli($rsdd3) && !$this->isShengli($rsdd3)) || $flag) && !$this->isBangli($rsdt2) && !$this->isShengli($rsdt2) && !$this->isBangli($rsdt3) && !$this->isShengli($rsdt3)){ return true;}
                }else if (($this->isChongli($rsdd2) || $this->isXingli($rsdd2)) && ($this->isXieli($rsdd3) || $this->isNoli($rsdd3) || $flag) && !$this->isBangli($rsdt2) && !$this->isShengli($rsdt2) && !$this->isBangli($rsdt3) && !$this->isShengli($rsdt3)){
                    return true;
                }
            }
        }else if ($this->isKeli($rsdd) || $this->isHaoli($rsdd) || $this->isChongli($rsdd) || $this->isXingli($rsdd)){
            if ($this->isKeli($rsdd2) || $this->isHaoli($rsdd2)){
                if (((!$this->isBangli($rsdd3) && !$this->isShengli($rsdd3)) || $flag) && ($this->isBangli($rsdt2) || $this->isShengli($rsdt2)) && ($this->isBangli($rsdt3) || $this->isShengli($rsdt3))){return true;}
            }else if (($this->isChongli($rsdd2) || $this->isXingli($rsdd2)) && ($this->isXieli($rsdd3) || $this->isNoli($rsdd3) || $flag) && ($this->isBangli($rsdt2) || $this->isShengli($rsdt2)) && ($this->isBangli($rsdt3) || $this->isShengli($rsdt3))){
                return true;
            }
        }
        return false;
    }

    public function isDThreeZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$isUsedInput, $isBangSengLiDE){
        $deqi = array_search($YearZ, $this->dizhi);
        $deqi2 = array_search($MonthZ, $this->dizhi);
        $tianan = array_search($DayG, $this->tiangan);
        $deqi3 = array_search($DayZ, $this->dizhi);
        $deqiHour = array_search($HourZ, $this->dizhi);
        $rsdt = $this->getRsdt($deqi2, $tianan);
        $rsdd = $this->getRsdd($deqi, $deqi2);
        $rsdd2 = $this->getRsdd($deqi3, $deqi2);
        $rsdd3 = $this->getRsdd($deqiHour, $deqi3);
        $rsdt2 = $this->getRsdt($deqi, $tianan);
        $rsdt3 = $this->getRsdt($deqi3, $tianan);
        if ($isUsedInput){
            $flag = $isBangSengLiDE;
        }else{
            $flag = ($this->isBangli($rsdt) || $this->isShengli($rsdt));
        }
        if ($flag){
            if (($this->isKeli($rsdd) || $this->isHaoli($rsdd) || $this->isChongli($rsdd) || $this->isXingli($rsdd)) && ($this->isKeli($rsdd2) || $this->isHaoli($rsdd2) || $this->isChongli($rsdd2) || $this->isXingli($rsdd2)) && ($this->isBangli($rsdd3) || $this->isShengli($rsdd3)) && !$this->isBangli($rsdt2) && !$this->isShengli($rsdt2) && !$this->isBangli($rsdt3) && !$this->isShengli($rsdt3)){ return true;}
        }else if (($this->isKeli($rsdd) || $this->isHaoli($rsdd) || $this->isChongli($rsdd) || $this->isXingli($rsdd)) && ($this->isKeli($rsdd2) || $this->isHaoli($rsdd2) || $this->isChongli($rsdd2) || $this->isXingli($rsdd2)) && ($this->isBangli($rsdd3) || $this->isShengli($rsdd3)) && ($this->isBangli($rsdt2) || $this->isShengli($rsdt2)) && ($this->isBangli($rsdt3) || $this->isShengli($rsdt3))){
            return true;
        }
        return false;
    }

    public function getShenGe($YearG,$YearZ,$MonthG,$MonthZ,$DayG,$DayZ,$HourG,$HourZ,$KongWang){
        $bazifenxi = null;
        $tianan = array_search($MonthG, $this->tiangan);
        $tianan2 = array_search($DayG, $this->tiangan);
        $deqi = array_search($DayZ, $this->dizhi);
        $tiananHour = array_search($HourG, $this->tiangan);
        $rstt = $this->getRstt($tianan, $tianan2);
        $rsdt = $this->getRsdt($deqi, $tianan2);
        $rstt2 = $this->getRstt($tiananHour, $tianan2);
        if ($KongWang != null && in_array($MonthZ,$KongWang)){
            if ((in_array($DayG,["甲","乙"]) && in_array($YearZ,["子","寅","卯","亥"])) || ("丙"==$DayG && in_array($YearZ,["寅","卯","巳","午","戌"])) || ("丁"==$DayG && in_array($YearZ,["寅","卯","巳","午","未"])) || (in_array($DayG,["戊","己"]) && in_array($YearZ,["巳","午","未","戌"])) || (in_array($DayG,["庚","辛"]) && in_array($YearZ,["丑","辰","申","酉"])) || ("壬"==$DayG && in_array($YearZ,["子","辰","申","酉","亥"])) || ("癸"==$DayG) && in_array($YearZ,["子","丑","申","酉","亥"])){
                $flag = false;
                if (!$this->isBangli($rstt) && !$this->isShengli($rstt) && $this->isStrongCForKongwang($YearG,$MonthG))
                {
                    $flag = true;
                }
                else if (!$this->isBangli($rsdt) && !$this->isShengli($rsdt) && $this->isStrongFForKongwang($YearZ,$DayZ,$HourZ,$KongWang))
                {
                    $flag = true;
                }
                else if (!$this->isBangli($rstt2) && !$this->isShengli($rstt2) && $this->isStrongGForKongwang($HourG,$HourZ,$KongWang))
                {
                    $flag = true;
                }
                $bazifenxi = $flag?"身旺":"从旺";
            }else if ((in_array($DayG,["甲","乙"]) && in_array($YearZ,["丑","辰","巳","午","未","申","酉","戌"])) || ("丙"==$DayG && in_array($YearZ,["子","丑","辰","未","申","酉","亥"])) || ("丁"==$DayG && in_array($YearZ,["子","丑","辰","申","酉","戌","亥"])) || (in_array($DayG,["戊","己"]) && in_array($YearZ,["子","丑","寅","卯","辰","申","酉","亥"])) || (in_array($DayG,["庚","辛"]) && in_array($YearZ,["子","寅","卯","巳","午","未","戌","亥"])) || ("壬"==$DayG && in_array($YearZ,["丑","寅","卯","巳","午","未","戌"])) || ("癸"==$DayG && in_array($YearZ,["寅","卯","辰","巳","午","未","戌"]))){
                $flag2 = false;
                if (($this->isBangli($rstt) || $this->isShengli($rstt)) && $this->isStrongCForKongwang($YearG,$MonthG))
                {
                    $flag2 = true;
                }
                else if (($this->isBangli($rsdt) || $this->isShengli($rsdt)) && $this->isStrongFForKongwang($YearZ,$DayZ,$HourZ,$KongWang))
                {
                    $flag2 = true;
                }
                else if (($this->isBangli($rstt2) || $this->isShengli($rstt2)) && $this->isStrongGForKongwang($HourG,$HourZ,$KongWang))
                {
                    $flag2 = true;
                }
                $bazifenxi = $flag2?"身弱":"从弱";
            }
        }
        else if ((in_array($DayG,["甲","乙"]) && in_array($MonthZ,["子","寅","卯","亥"])) || ("丙"==$DayG && in_array($MonthZ,["寅","卯","巳","午"])) || ("丁"==$DayG && in_array($MonthZ,["寅","卯","巳","午","未"])) || ("戊"==$DayG && in_array($MonthZ,["巳","午","未","戌"])) || ("己"==$DayG && in_array($MonthZ,["巳","午","未","戌"])) || ("庚"==$DayG && in_array($MonthZ,["辰","申","酉"])) || ("辛"==$DayG && in_array($MonthZ,["丑","辰","申","酉"])) || ("壬"==$DayG && in_array($MonthZ,["子","申","酉","亥"])) || ("癸"==$DayG && in_array($MonthZ,["子","丑","申","酉","亥"])))
        {
            if ($this->isDTwoZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$KongWang,false, false))
            {
                $bazifenxi = "身弱";
            }
            else if ($this->isDThreeZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,false, false))
            {
                $bazifenxi = "身弱";
            }
            else if ((!$this->isBangli($rstt) && !$this->isShengli($rstt) && $this->isStrongCForNotKongwang($YearG,$YearZ,$MonthG,$MonthZ,$DayG,$DayZ,$HourZ,false, false)) || (!$this->isBangli($rsdt) && !$this->isShengli($rsdt) && $this->isStrongFForNotKongwang($MonthZ,$DayZ,$HourZ,$KongWang)) || (!$this->isBangli($rstt2) && !$this->isShengli($rstt2) && $this->isStrongGForNotKongwang($HourG,$HourZ,$KongWang)))
            {
                $bazifenxi = "身旺";
            }
            else
            {
                $bazifenxi = "从旺";
            }
        }
        else if ((in_array($DayG,["甲","乙"]) && in_array($MonthZ,["丑","辰","巳","午","未","申","酉","戌"])) || ("丙"==$DayG && in_array($MonthZ,["子","丑","辰","申","酉","亥"])) || ("丁"==$DayG && in_array($MonthZ,["子","丑","辰","申","酉","亥"])) || (in_array($DayG,["戊","己"]) && in_array($MonthZ,["子","寅","卯","申","酉","亥"])) || (in_array($DayG,["庚","辛"]) && in_array($MonthZ,["子","寅","卯","巳","午","未","戌","亥"])) || ("壬"==$DayG && in_array($MonthZ,["寅","卯","巳","午","未","戌"])) || ("癸"==$DayG && in_array($MonthZ,["寅","卯","巳","午","未","戌"])))
        {
            if ($this->isDTwoZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$KongWang,false, false))
            {
                $bazifenxi = "身旺";
            }
            else if ($this->isDThreeZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,false, false))
            {
                $bazifenxi = "身旺";
            }
            else if ((($this->isBangli($rstt) || $this->isShengli($rstt)) && $this->isStrongCForNotKongwang($YearG,$YearZ,$MonthG,$MonthZ,$DayG,$DayZ,$HourZ,false, false)) || (($this->isBangli($rsdt) || $this->isShengli($rsdt)) && $this->isStrongFForNotKongwang($MonthZ,$DayZ,$HourZ,$KongWang)) || (($this->isBangli($rstt2) || $this->isShengli($rstt2)) && $this->isStrongGForNotKongwang($HourG,$HourZ,$KongWang)))
            {
                $bazifenxi = "身弱";
            }
            else
            {
                $bazifenxi = "从弱";
            }
        }
        else if (("丙"==$DayG && "戌"==$MonthZ && "丙"==$MonthG) || ("丙"==$DayG && "未"==$MonthZ && "丁"==$MonthG) || ("丁"==$DayG && "戌"==$MonthZ && "丙"==$MonthG) || (in_array($DayG,["戊","己"]) && in_array($MonthZ,["丑","辰"]) && in_array($MonthG,["己","戊"])) || ("庚"==$DayG && "丑"==$MonthZ && in_array($MonthG,["辛","己"])) || ("壬"==$DayG && "丑"==$MonthZ && in_array($MonthG,["辛","癸"])) || ("壬"==$DayG && "辰"==$MonthZ && in_array($MonthG,["庚","壬"])) || ("癸"==$DayG && "辰"==$MonthZ && in_array($MonthG,["庚","壬"])))
        {
            if ($this->isDTwoZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$KongWang,true, true))
            {
                $bazifenxi = "身弱";
            }
            else if ($this->isDThreeZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,true, true))
            {
                $bazifenxi = "身弱";
            }
            else
            {
                $flag3 = false;
					if (!in_array($DayG,["丙","丁"]) || "戌" != $MonthZ || "丙" != $MonthG)
                    {
                        $flag3 = (!$this->isBangli($rstt) && !$this->isShengli($rstt) && $this->isStrongCForNotKongwang($YearG,$YearZ,$MonthG,$MonthZ,$DayG,$DayZ,$HourZ,true, true));
                    }
					if ($flag3 || (!$this->isBangli($rsdt) && !$this->isShengli($rsdt) && $this->isStrongFForNotKongwang($MonthZ,$DayZ,$HourZ,$KongWang)) || (!$this->isBangli($rstt2) && !$this->isShengli($rstt2) && $this->isStrongGForNotKongwang($HourG,$HourZ,$KongWang)))
                    {
                        $bazifenxi = "身旺";
                    }
                    else
                    {
                        $bazifenxi = "从旺";
                    }
				}
        }
        else if (("丙"==$DayG && "戌"==$MonthZ && "丙"!=$MonthG) || ("丙"==$DayG && "未"==$MonthZ && "丁"!=$MonthG) || ("丁"==$DayG && "戌"==$MonthZ && "丙"!=$MonthG) || (in_array($DayG,["戊","己"]) && in_array($MonthZ,["丑","辰"]) && !in_array($MonthG,["己","戊"])) || ("庚"==$DayG && "丑"==$MonthZ && !in_array($MonthG,["辛","己"])) || ("壬"==$DayG && "丑"==$MonthZ && !in_array($MonthG,["辛","癸"])) || ("壬"==$DayG && "辰"==$MonthZ && !in_array($MonthG,["庚","壬"])) || ("癸"==$DayG && "辰"==$MonthZ && !in_array($MonthG,["庚","壬"])))
        {
            if ($this->isDTwoZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,$KongWang,true, false))
            {
                $bazifenxi = "身旺";
            }
            else if ($this->isDThreeZZ($YearZ,$MonthZ,$DayG,$DayZ,$HourZ,true, false))
            {
                $bazifenxi = "身旺";
            }
            else if ((($this->isBangli($rstt) || $this->isShengli($rstt)) && $this->isStrongCForNotKongwang($YearG,$YearZ,$MonthG,$MonthZ,$DayG,$DayZ,$HourZ,true, false)) || (($this->isBangli($rsdt) || $this->isShengli($rsdt)) && $this->isStrongFForNotKongwang($MonthZ,$DayZ,$HourZ,$KongWang)) || (($this->isBangli($rstt2) || $this->isShengli($rstt2)) && $this->isStrongGForNotKongwang($HourG,$HourZ,$KongWang)))
            {
                $bazifenxi = "身弱";
            }
            else
            {
                $bazifenxi = "从弱";
            }
        }
        return $bazifenxi;
    }



    /*******/
    public function calculateLiuqin($YearG,$MonthG,$DayG,$HourG,$bazifenxi,$sex,$Year_liuqin,$Month_liuqin,$Hour_liuqin){
        $RightOrWrong = ["×","√"];
        $tianan = array_search($YearG, $this->tiangan);
        $tianan2 = array_search($MonthG, $this->tiangan);
        $tianan3 = array_search($DayG, $this->tiangan);
        $tiananHour = array_search($HourG, $this->tiangan);
        $rstt = $this->getRstt($tianan, $tianan2);
        $rstt2 = $this->getRstt($tianan2, $tianan3);
        $rstt3 = $this->getRstt($tiananHour, $tianan3);
        $num = 0;
        $num2 = 0;
        $num3 = 0;
        if ("从弱"==$bazifenxi || "身旺"==$bazifenxi){
            if ($this->isBangli($rstt2) || $this->isShengli($rstt2)){
                $num2 = 0;
            }else{
                $num2 = 1;
            }
            if ($this->isBangli($rstt3) || $this->isShengli($rstt3)){
                $num3 = 0;
            }else{
                $num3 = 1;
            }
            if ($this->isBangli($rstt) || $this->isShengli($rstt)){
                $num = $num2;
            }else{
                $num = ($num2 + 1) % 2;
            }
        }
        elseif ("身弱"==$bazifenxi || "从旺"==$bazifenxi){
            if ($this->isBangli($rstt2) || $this->isShengli($rstt2)){
                $num2 = 1;
            }else{
                $num2 = 0;
            }
            if ($this->isBangli($rstt3) || $this->isShengli($rstt3)){
                $num3 = 1;
            }else{
                $num3 = 0;
            }
            if ($this->isBangli($rstt) || $this->isShengli($rstt)){
                $num = $num2;
            }else{
                $num = ($num2 + 1) % 2;
            }
        }
        $YearRW = $RightOrWrong[$num];
        $MonthRW = $RightOrWrong[$num2];
        $HourRW = $RightOrWrong[$num3];
        
        $Liuqin_zheng = ["官", "才", "印", "伤", "劫"];
        $Liuqin_pian = ["杀",  "财", "枭", "食", "比"];
        $Liuqin_link = [2,0,4,1,3];

        $text_arr = array_diff($Liuqin_zheng,[$Year_liuqin,$Month_liuqin,$Hour_liuqin]);
        $text2_arr = array_diff($Liuqin_pian,[$Year_liuqin,$Month_liuqin,$Hour_liuqin]);

        $flag = false;
        $flag2 = false;
        $num4 = -1;
        $num5 = -1;
        if(array_search($Month_liuqin, $Liuqin_zheng) !== false){
            $flag = true;
            $num4 = array_search($Month_liuqin, $Liuqin_zheng);
        }
        if(array_search($Hour_liuqin, $Liuqin_zheng) !== false){
            $flag2 = true;
            $num5 = array_search($Hour_liuqin, $Liuqin_zheng);
        }

        $dictionary = [];
        $dictionary2 = [];
        if ($flag && !$flag2){
            $liuqinPianIndex = array_search($Hour_liuqin,$Liuqin_pian);//不在正，就一定在偏
            $text3 = $Liuqin_zheng[$Liuqin_link[$num4]];
            $text4 = $Liuqin_pian[$Liuqin_link[$liuqinPianIndex]];
            $dictionary2[$text3] = 1;
            $dictionary2[$text4] = 1;
            foreach ($text_arr as $l){
                if ($text3 != $l){
                    $dictionary2[$l] = 0;
                }
            }
            foreach ($text2_arr as $m){
                if ($text4 != $m){
                    $dictionary2[$m] = 0;
                }
            }
        }
        else if (!$flag && $flag2){
            $liuqinPianIndex2 = array_search($Month_liuqin,$Liuqin_pian);
            $text5 = $Liuqin_pian[$Liuqin_link[$liuqinPianIndex2]];
            $text6 = $Liuqin_zheng[$Liuqin_link[$num5]];
            $dictionary2[$text5] = 1;
            $dictionary2[$text6] = 1;
            foreach ($text_arr as $n){
                if ($text6 != $n){
                    $dictionary2[$n] = 0;
                }
            }
            foreach ($text2_arr as $n){
                if ($text5 != $n){
                    $dictionary2[$n] = 0;
                }
            }
        }
        else if (!$flag && !$flag2){
            if (!$sex){
                $liuqinPianIndex2 = array_search($Month_liuqin,$Liuqin_pian);
                $text7 = $Liuqin_zheng[$Liuqin_link[$liuqinPianIndex2]];
                $dictionary2[$text7] = 0;
                $dictionary[$Liuqin_zheng[$liuqinPianIndex2]] = ($num2 + 1) % 2;
                foreach ($text_arr as $n){
                    if ($text7 != $n){
                        $dictionary2[$n] = 1;
                    }
                }

                $liuqinPianIndex = array_search($Hour_liuqin,$Liuqin_pian);
                $text8 = $Liuqin_pian[$Liuqin_link[$liuqinPianIndex]];
                $dictionary2[$text8] = 1;
                foreach ($text2_arr as $n){
                    if ($text8 != $n){
                        $dictionary2[$n] = 0;
                    }
                }
            }
            else{
                $liuqinPianIndex2 = array_search($Month_liuqin,$Liuqin_pian);
                $text9 = $Liuqin_pian[$Liuqin_link[$liuqinPianIndex2]];
                $dictionary2[$text9]=1;
                foreach ($text2_arr as $n){
                    if ($text9 != $n){
                        $dictionary2[$n] = 0;
                    }
                }

                $liuqinPianIndex = array_search($Hour_liuqin,$Liuqin_pian);
                $text10 = $Liuqin_zheng[$Liuqin_link[$liuqinPianIndex]];
                $dictionary2[$text10]=0;
                $dictionary[$Liuqin_zheng[$liuqinPianIndex]]=($num3 + 1) % 2;
                foreach ($text_arr as $n){
                    if ($text10 != $n){
                        $dictionary2[$n] = 1;
                    }
                }
            }
        }
        else if (!$sex){
            $text11 = $Liuqin_zheng[$Liuqin_link[$num4]];
            $dictionary2[$text11]=1;
            foreach ($text_arr as $n){
                if ($text11 != $n){
                    $dictionary2[$n] = 0;
                }
            }

            $text12 = $Liuqin_pian[$Liuqin_link[$num5]];
            $dictionary2[$text12]=0;
            $dictionary[$Liuqin_pian[$num5]]=($num3 + 1) % 2;
            foreach ($text2_arr as $n){
                if ($text12 != $n){
                    $dictionary2[$n] = 1;
                }
            }
        }
        else{
            $text13 = $Liuqin_pian[$Liuqin_link[$num4]];
            $dictionary2[$text13]=0;
            $dictionary[$Liuqin_pian[$num4]]=($num2 + 1) % 2;
            foreach ($text2_arr as $n){
                if ($text13 != $n){
                    $dictionary2[$n] = 1;
                }
            }
            $text14 = $Liuqin_zheng[$Liuqin_link[$num5]];
            $dictionary2[$text14]=1;
            foreach ($text_arr as $n){
                if ($text14 != $n){
                    $dictionary2[$n] = 0;
                }
            }
        }

        if ("从弱"==$bazifenxi || "身旺"==$bazifenxi){
            foreach ($dictionary2 as $key=>$value){
                if (!array_key_exists($key, $dictionary)){
                    if (in_array($key, ["官","杀","才","财","伤","食"])){
                        $dictionary[$key] = $value?1:0;
                    }else{
                        $dictionary[$key] = $value?0:1;
                    }
                }
            }
        }
        if ("身弱"==$bazifenxi || "从旺"==$bazifenxi){
            foreach ($dictionary2 as $key2=>$value2){
                if (!array_key_exists($key2, $dictionary)){
                    if (in_array($key2, ["印","枭","劫","比"])){
                        $dictionary[$key2] = $value2?1:0;
                    }else{
                        $dictionary[$key2] = $value2?0:1;
                    }
                }
            }
        }
        $text = "";
        $text2 = "";
        foreach ($text_arr as $n){
            if (array_key_exists($n,$dictionary)){
                $num16 = $dictionary[$n];
                $text = $text . $n . $RightOrWrong[$num16];
            }
        }
        foreach ($text2_arr as $n){
            if (array_key_exists($n,$dictionary)){
                $num18 = $dictionary[$n];
                $text2 = $text2 . $n . $RightOrWrong[$num18];
            }
        }

        if ($flag && !$flag2){
            $Liuqin_1 = $text;
            $Liuqin_2 = $text2;
            return [$YearRW,$MonthRW,$HourRW,$Liuqin_1,$Liuqin_2];
        }
        if (!$flag && $flag2){
            $Liuqin_1 = $text2;
            $Liuqin_2 = $text;
            return [$YearRW,$MonthRW,$HourRW,$Liuqin_1,$Liuqin_2];
        }
        if (!$sex){
            $Liuqin_1 = $text;
            $Liuqin_2 = $text2;
            return [$YearRW,$MonthRW,$HourRW,$Liuqin_1,$Liuqin_2];
        }
        $Liuqin_1 = $text2;
        $Liuqin_2 = $text;
        return [$YearRW,$MonthRW,$HourRW,$Liuqin_1,$Liuqin_2];
    }

    //关于几字算命
    public function jizhi_shuanmin($year=1990,$month=7,$day=6,$birthday_Y=2016,$birthday_M=5,$hour=13){

        $times=strtotime("$year-$month-$day");
        for ($i=0;$i<=40;$i++){
            $time_Y=date('Y',$times-$i*86400);
            $time_m=date('m',$times-$i*86400);
            $time_d=date('d',$times-$i*86400);
            $term_namel=$this->getJieQi($time_Y, $time_m, $time_d);
            if($term_namel!=''){
                $si=$i;
                break;
            }
        }

        $birthday = $birthday_Y;
        if($birthday_M==1) {
            if ($term_namel == 12) {
                $birthday = $birthday_Y - 1;
            }else if($term_namel == 1){
                if($si==0){
                    if($hour<12){
                        $birthday=$birthday_Y-1;
                    }
                }
            }

        }
        if($si==0){
            if($hour<12){
                $term_namel=$term_namel-1;
            }
        }
        if($birthday==$birthday_Y && $birthday_M==$term_namel){
            $jieqi='八字算命';
        }elseif($birthday==$birthday_Y && $birthday_M!=$term_namel){
            $jieqi='九字算命';
        }elseif($birthday!=$birthday_Y && $birthday_M!=$term_namel){
            $jieqi='十字算命';
        }

        return $jieqi;

    }
    /**
     * 节气通用算法
     */
    public function getJieQi($_year, $month, $day)
    {

        $year = substr($_year,-2)+0;
                 $coefficient = array(
                     array(5.4055,2019,-1),//小寒
                     array(20.12,2082,1),//大寒
                     array(3.87),//立春
                     array(18.74,2026,-1),//雨水
                     array(5.63),//惊蛰
                     array(20.646,2084,1),//春分
                     array(4.81),//清明
                     array(20.1),//谷雨
                     array(5.52,1911,1),//立夏
                     array(21.04,2008,1),//小满
                     array(5.678,1902,1),//芒种
                     array(21.37,1928,1),//夏至
                     array(7.108,2016,1),//小暑
                     array(22.83,1922,1),//大暑
                     array(7.5,2002,1),//立秋
                     array(23.13),//处暑
                     array(7.646,1927,1),//白露
                     array(23.042,1942,1),//秋分
                     array(8.318),//寒露
                     array(23.438,2089,1),//霜降
                     array(7.438,2089,1),//立冬
                     array(22.36,1978,1),//小雪
                     array(7.18,1954,1),//大雪
                     array(21.94,2021,-1)//冬至
         );
//         $term_name = array(
//             "小寒","","立春","","惊蛰","","清明","",
//             "立夏","","芒种","","小暑","","立秋","",
//             "白露","","寒露","","立冬","","大雪","");
        $term_name = array(
            "12","","1","","2","","3","",
            "4","","5","","6","","7","",
            "8","","9","","10","","11","");
         $idx1 = ($month-1)*2;
         $_leap_value = floor(($year-1)/4);
         $day1 = floor($year*0.2422+$coefficient[$idx1][0])-$_leap_value;
         if(isset($coefficient[$idx1][1])&&$coefficient[$idx1][1]==$_year) $day1 += $coefficient[$idx1][2];
        $day2 = floor($year*0.2422+$coefficient[$idx1+1][0])-$_leap_value;
        if(isset($coefficient[$idx1+1][1])&&$coefficient[$idx1+1][1]==$_year) $day1 += $coefficient[$idx1+1][2];
         $data='';
         if($day==$day1){
             $data=$term_name[$idx1];
         }else if($day==$day2){
             $data=$term_name[$idx1+1];
         }else if($day==$day1 && $day==$day2) {
             $data = $term_name[$idx1];
         }
        return $data;
    }

    public function isHongSe($kongwang,$dizhi,$yearZ,$monthZ,$hourZ){
        $result = false;
        if ($kongwang != null && in_array($dizhi, $kongwang)){
            if ($dizhi==$yearZ){
                if ($dizhi==$monthZ || $dizhi==$hourZ)
                {
                    $result = true;
                }
            }else{
                $result = true;
            }
        }

        return $result;
    }
    
    public function test(){
        $str = $this->getShenGe('丙', '寅', '癸', '巳', '丙', '子', '丁', '酉', ['申','酉']);
        var_dump($str);
    }
}