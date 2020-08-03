<?php
/**
 * Created by PhpStorm.
 * User: ZhouChengWu
 * Date: 2018/4/16
 * Time: 21:33
 */
namespace Miudrive\Controller;
class CalendarController extends CommonController
{
    public $lunarInfo;
    public $solarMonth;
    public $Gan;
    public $Zhi;
    public $Animals;
    public $solarTerm;
    public $sTermInfo;

    public function _initialize()
    {
        $this->lunarInfo = [0x04bd8,0x04ae0,0x0a570,0x054d5,0x0d260,0x0d950,0x16554,0x056a0,0x09ad0,0x055d2,//1900-1909
            0x04ae0,0x0a5b6,0x0a4d0,0x0d250,0x1d255,0x0b540,0x0d6a0,0x0ada2,0x095b0,0x14977,//1910-1919
            0x04970,0x0a4b0,0x0b4b5,0x06a50,0x06d40,0x1ab54,0x02b60,0x09570,0x052f2,0x04970,//1920-1929
            0x06566,0x0d4a0,0x0ea50,0x06e95,0x05ad0,0x02b60,0x186e3,0x092e0,0x1c8d7,0x0c950,//1930-1939
            0x0d4a0,0x1d8a6,0x0b550,0x056a0,0x1a5b4,0x025d0,0x092d0,0x0d2b2,0x0a950,0x0b557,//1940-1949
            0x06ca0,0x0b550,0x15355,0x04da0,0x0a5b0,0x14573,0x052b0,0x0a9a8,0x0e950,0x06aa0,//1950-1959
            0x0aea6,0x0ab50,0x04b60,0x0aae4,0x0a570,0x05260,0x0f263,0x0d950,0x05b57,0x056a0,//1960-1969
            0x096d0,0x04dd5,0x04ad0,0x0a4d0,0x0d4d4,0x0d250,0x0d558,0x0b540,0x0b6a0,0x195a6,//1970-1979
            0x095b0,0x049b0,0x0a974,0x0a4b0,0x0b27a,0x06a50,0x06d40,0x0af46,0x0ab60,0x09570,//1980-1989
            0x04af5,0x04970,0x064b0,0x074a3,0x0ea50,0x06b58,0x055c0,0x0ab60,0x096d5,0x092e0,//1990-1999
            0x0c960,0x0d954,0x0d4a0,0x0da50,0x07552,0x056a0,0x0abb7,0x025d0,0x092d0,0x0cab5,//2000-2009
            0x0a950,0x0b4a0,0x0baa4,0x0ad50,0x055d9,0x04ba0,0x0a5b0,0x15176,0x052b0,0x0a930,//2010-2019
            0x07954,0x06aa0,0x0ad50,0x05b52,0x04b60,0x0a6e6,0x0a4e0,0x0d260,0x0ea65,0x0d530,//2020-2029
            0x05aa0,0x076a3,0x096d0,0x04afb,0x04ad0,0x0a4d0,0x1d0b6,0x0d250,0x0d520,0x0dd45,//2030-2039
            0x0b5a0,0x056d0,0x055b2,0x049b0,0x0a577,0x0a4b0,0x0aa50,0x1b255,0x06d20,0x0ada0,//2040-2049
            0x14b63,0x09370,0x049f8,0x04970,0x064b0,0x168a6,0x0ea50,0x06b20,0x1a6c4,0x0aae0,//2050-2059
            0x0a2e0,0x0d2e3,0x0c960,0x0d557,0x0d4a0,0x0da50,0x05d55,0x056a0,0x0a6d0,0x055d4,//2060-2069
            0x052d0,0x0a9b8,0x0a950,0x0b4a0,0x0b6a6,0x0ad50,0x055a0,0x0aba4,0x0a5b0,0x052b0,//2070-2079
            0x0b273,0x06930,0x07337,0x06aa0,0x0ad50,0x14b55,0x04b60,0x0a570,0x054e4,0x0d160,//2080-2089
            0x0e968,0x0d520,0x0daa0,0x16aa6,0x056d0,0x04ae0,0x0a9d4,0x0a2d0,0x0d150,0x0f252,//2090-2099
            0x0d520];//2100
        
        $this->solarMonth = [31,28,31,30,31,30,31,31,30,31,30,31];
        
        $this->Gan = ["甲","乙","丙","丁","戊","己","庚","辛","壬","癸"];
        
        $this->Zhi = ["子","丑","寅","卯","辰","巳","午","未","申","酉","戌","亥"];
        
        $this->Animals = ["鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪"];
        
        $this->solarTerm = ["小寒","大寒","立春","雨水","惊蛰","春分","清明","谷雨","立夏","小满","芒种","夏至","小暑","大暑","立秋","处暑","白露","秋分","寒露","霜降","立冬","小雪","大雪","冬至"];
        
        $this->sTermInfo = ['9778397bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e','97bcf97c3598082c95f8c965cc920f',
        '97bd0b06bdb0722c965ce1cfcc920f','b027097bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e',
        '97bcf97c359801ec95f8c965cc920f','97bd0b06bdb0722c965ce1cfcc920f','b027097bd097c36b0b6fc9274c91aa',
        '97b6b97bd19801ec9210c965cc920e','97bcf97c359801ec95f8c965cc920f','97bd0b06bdb0722c965ce1cfcc920f',
        'b027097bd097c36b0b6fc9274c91aa','9778397bd19801ec9210c965cc920e','97b6b97bd19801ec95f8c965cc920f',
        '97bd09801d98082c95f8e1cfcc920f','97bd097bd097c36b0b6fc9210c8dc2','9778397bd197c36c9210c9274c91aa',
        '97b6b97bd19801ec95f8c965cc920e','97bd09801d98082c95f8e1cfcc920f','97bd097bd097c36b0b6fc9210c8dc2',
        '9778397bd097c36c9210c9274c91aa','97b6b97bd19801ec95f8c965cc920e','97bcf97c3598082c95f8e1cfcc920f',
        '97bd097bd097c36b0b6fc9210c8dc2','9778397bd097c36c9210c9274c91aa','97b6b97bd19801ec9210c965cc920e',
        '97bcf97c3598082c95f8c965cc920f','97bd097bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa',
        '97b6b97bd19801ec9210c965cc920e','97bcf97c3598082c95f8c965cc920f','97bd097bd097c35b0b6fc920fb0722',
        '9778397bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e','97bcf97c359801ec95f8c965cc920f',
        '97bd097bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e',
        '97bcf97c359801ec95f8c965cc920f','97bd097bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa',
        '97b6b97bd19801ec9210c965cc920e','97bcf97c359801ec95f8c965cc920f','97bd097bd07f595b0b6fc920fb0722',
        '9778397bd097c36b0b6fc9210c8dc2','9778397bd19801ec9210c9274c920e','97b6b97bd19801ec95f8c965cc920f',
        '97bd07f5307f595b0b0bc920fb0722','7f0e397bd097c36b0b6fc9210c8dc2','9778397bd097c36c9210c9274c920e',
        '97b6b97bd19801ec95f8c965cc920f','97bd07f5307f595b0b0bc920fb0722','7f0e397bd097c36b0b6fc9210c8dc2',
        '9778397bd097c36c9210c9274c91aa','97b6b97bd19801ec9210c965cc920e','97bd07f1487f595b0b0bc920fb0722',
        '7f0e397bd097c36b0b6fc9210c8dc2','9778397bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e',
        '97bcf7f1487f595b0b0bb0b6fb0722','7f0e397bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa',
        '97b6b97bd19801ec9210c965cc920e','97bcf7f1487f595b0b0bb0b6fb0722','7f0e397bd097c35b0b6fc920fb0722',
        '9778397bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e','97bcf7f1487f531b0b0bb0b6fb0722',
        '7f0e397bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa','97b6b97bd19801ec9210c965cc920e',
        '97bcf7f1487f531b0b0bb0b6fb0722','7f0e397bd07f595b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa',
        '97b6b97bd19801ec9210c9274c920e','97bcf7f0e47f531b0b0bb0b6fb0722','7f0e397bd07f595b0b0bc920fb0722',
        '9778397bd097c36b0b6fc9210c91aa','97b6b97bd197c36c9210c9274c920e','97bcf7f0e47f531b0b0bb0b6fb0722',
        '7f0e397bd07f595b0b0bc920fb0722','9778397bd097c36b0b6fc9210c8dc2','9778397bd097c36c9210c9274c920e',
        '97b6b7f0e47f531b0723b0b6fb0722','7f0e37f5307f595b0b0bc920fb0722','7f0e397bd097c36b0b6fc9210c8dc2',
        '9778397bd097c36b0b70c9274c91aa','97b6b7f0e47f531b0723b0b6fb0721','7f0e37f1487f595b0b0bb0b6fb0722',
        '7f0e397bd097c35b0b6fc9210c8dc2','9778397bd097c36b0b6fc9274c91aa','97b6b7f0e47f531b0723b0b6fb0721',
        '7f0e27f1487f595b0b0bb0b6fb0722','7f0e397bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa',
        '97b6b7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722','7f0e397bd097c35b0b6fc920fb0722',
        '9778397bd097c36b0b6fc9274c91aa','97b6b7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722',
        '7f0e397bd097c35b0b6fc920fb0722','9778397bd097c36b0b6fc9274c91aa','97b6b7f0e47f531b0723b0b6fb0721',
        '7f0e27f1487f531b0b0bb0b6fb0722','7f0e397bd07f595b0b0bc920fb0722','9778397bd097c36b0b6fc9274c91aa',
        '97b6b7f0e47f531b0723b0787b0721','7f0e27f0e47f531b0b0bb0b6fb0722','7f0e397bd07f595b0b0bc920fb0722',
        '9778397bd097c36b0b6fc9210c91aa','97b6b7f0e47f149b0723b0787b0721','7f0e27f0e47f531b0723b0b6fb0722',
        '7f0e397bd07f595b0b0bc920fb0722','9778397bd097c36b0b6fc9210c8dc2','977837f0e37f149b0723b0787b0721',
        '7f07e7f0e47f531b0723b0b6fb0722','7f0e37f5307f595b0b0bc920fb0722','7f0e397bd097c35b0b6fc9210c8dc2',
        '977837f0e37f14998082b0787b0721','7f07e7f0e47f531b0723b0b6fb0721','7f0e37f1487f595b0b0bb0b6fb0722',
        '7f0e397bd097c35b0b6fc9210c8dc2','977837f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721',
        '7f0e27f1487f531b0b0bb0b6fb0722','7f0e397bd097c35b0b6fc920fb0722','977837f0e37f14998082b0787b06bd',
        '7f07e7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722','7f0e397bd097c35b0b6fc920fb0722',
        '977837f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722',
        '7f0e397bd07f595b0b0bc920fb0722','977837f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721',
        '7f0e27f1487f531b0b0bb0b6fb0722','7f0e397bd07f595b0b0bc920fb0722','977837f0e37f14998082b0787b06bd',
        '7f07e7f0e47f149b0723b0787b0721','7f0e27f0e47f531b0b0bb0b6fb0722','7f0e397bd07f595b0b0bc920fb0722',
        '977837f0e37f14998082b0723b06bd','7f07e7f0e37f149b0723b0787b0721','7f0e27f0e47f531b0723b0b6fb0722',
        '7f0e397bd07f595b0b0bc920fb0722','977837f0e37f14898082b0723b02d5','7ec967f0e37f14998082b0787b0721',
        '7f07e7f0e47f531b0723b0b6fb0722','7f0e37f1487f595b0b0bb0b6fb0722','7f0e37f0e37f14898082b0723b02d5',
        '7ec967f0e37f14998082b0787b0721','7f07e7f0e47f531b0723b0b6fb0722','7f0e37f1487f531b0b0bb0b6fb0722',
        '7f0e37f0e37f14898082b0723b02d5','7ec967f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721',
        '7f0e37f1487f531b0b0bb0b6fb0722','7f0e37f0e37f14898082b072297c35','7ec967f0e37f14998082b0787b06bd',
        '7f07e7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722','7f0e37f0e37f14898082b072297c35',
        '7ec967f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722',
        '7f0e37f0e366aa89801eb072297c35','7ec967f0e37f14998082b0787b06bd','7f07e7f0e47f149b0723b0787b0721',
        '7f0e27f1487f531b0b0bb0b6fb0722','7f0e37f0e366aa89801eb072297c35','7ec967f0e37f14998082b0723b06bd',
        '7f07e7f0e47f149b0723b0787b0721','7f0e27f0e47f531b0723b0b6fb0722','7f0e37f0e366aa89801eb072297c35',
        '7ec967f0e37f14998082b0723b06bd','7f07e7f0e37f14998083b0787b0721','7f0e27f0e47f531b0723b0b6fb0722',
        '7f0e37f0e366aa89801eb072297c35','7ec967f0e37f14898082b0723b02d5','7f07e7f0e37f14998082b0787b0721',
        '7f07e7f0e47f531b0723b0b6fb0722','7f0e36665b66aa89801e9808297c35','665f67f0e37f14898082b0723b02d5',
        '7ec967f0e37f14998082b0787b0721','7f07e7f0e47f531b0723b0b6fb0722','7f0e36665b66a449801e9808297c35',
        '665f67f0e37f14898082b0723b02d5','7ec967f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721',
        '7f0e36665b66a449801e9808297c35','665f67f0e37f14898082b072297c35','7ec967f0e37f14998082b0787b06bd',
        '7f07e7f0e47f531b0723b0b6fb0721','7f0e26665b66a449801e9808297c35','665f67f0e37f1489801eb072297c35',
        '7ec967f0e37f14998082b0787b06bd','7f07e7f0e47f531b0723b0b6fb0721','7f0e27f1487f531b0b0bb0b6fb0722'];
    }

    //返回农历y年一整年的总天数
    public function lYearDays($y){
        $sum = 348;
        for($i=0x8000; $i>0x8; $i>>=1) { $sum += ($this->lunarInfo[$y-1900] & $i)? 1: 0; }
        return($sum+$this->leapDays($y));
    }

    //返回农历y年闰月的天数 若该年没有闰月则返回0
    public function leapDays($y){
        if($this->leapMonth($y))  {
            return(($this->lunarInfo[$y-1900] & 0x10000)? 30: 29);
        }
        return 0;
    }

    //返回农历y年闰月是哪个月；若y年没有闰月 则返回0
    public function leapMonth($y){
        return($this->lunarInfo[$y-1900] & 0xf);
    }

    //返回农历y年m月（非闰月）的总天数，计算m为闰月时的天数请使用leapDays方法
    public function monthDays($y,$m) {
        if($m>12 || $m<1) {return -1;}//月份参数从1至12，参数错误返回-1
        return( ($this->lunarInfo[$y-1900] & (0x10000>>$m))? 30: 29 );
    }

    //返回公历(!)y年m月的天数
    public function solarDays($y,$m) {
        if($m>12 || $m<1) {return -1;} //若参数错误 返回-1
        $ms = $m-1;
        if($ms==1) { //2月份的闰平规律测算后确认返回28或29
            return((($y%4 == 0) && ($y%100 != 0) || ($y%400 == 0))? 29: 28);
        }else {
            return($this->solarMonth[$ms]);
        }
    }

    //农历年份转换为干支纪年
    public function toGanZhiYear($lYear) {
        $ganKey = ($lYear - 3) % 10;
        $zhiKey = ($lYear - 3) % 12;
        if($ganKey == 0) $ganKey = 10;//如果余数为0则为最后一个天干
        if($zhiKey == 0) $zhiKey = 12;//如果余数为0则为最后一个地支
        return $this->Gan[$ganKey-1].$this->Zhi[$zhiKey-1];
    }

    //传入offset偏移量返回干支 offset 相对甲子的偏移量
    public function toGanZhi($offset) {
        return $this->Gan[$offset%10].$this->Zhi[$offset%12];
    }

    /**
     * 传入公历(!)y年获得该年第n个节气的公历日期
     * @param y公历年(1900-2100)；n二十四节气中的第几个节气(1~24)；从n=1(小寒)算起
     * @return day Number
     * @eg:var _24 = calendar.getTerm(1987,3) ;//_24=4;意即1987年2月4日立春
     */
    public function getTerm($y,$n) {
        if($y<1900 || $y>2100) {return -1;}
        if($n<1 || $n>24) {return -1;}
        $_table = $this->sTermInfo[$y-1900];
        $_info = [
            hexdec(substr($_table,0,5)),
            hexdec(substr($_table,5,5)),
            hexdec(substr($_table,10,5)),
            hexdec(substr($_table,15,5)),
            hexdec(substr($_table,20,5)),
            hexdec(substr($_table,25,5))
        ];
        $_calday = [
            substr($_info[0],0,1),
            substr($_info[0],1,2),
            substr($_info[0],3,1),
            substr($_info[0],4,2),

            substr($_info[1],0,1),
            substr($_info[1],1,2),
            substr($_info[1],3,1),
            substr($_info[1],4,2),

            substr($_info[2],0,1),
            substr($_info[2],1,2),
            substr($_info[2],3,1),
            substr($_info[2],4,2),

            substr($_info[3],0,1),
            substr($_info[3],1,2),
            substr($_info[3],3,1),
            substr($_info[3],4,2),

            substr($_info[4],0,1),
            substr($_info[4],1,2),
            substr($_info[4],3,1),
            substr($_info[4],4,2),

            substr($_info[5],0,1),
            substr($_info[5],1,2),
            substr($_info[5],3,1),
            substr($_info[5],4,2),
        ];
        return intval($_calday[$n-1]);
    }

    /**
     * 年份转生肖[!仅能大致转换] => 精确划分生肖分界线是“立春”
     * @param y year
     * @return Cn string
     * @eg:var animal = calendar.getAnimal(1987) ;//animal='兔'
     */
    public function getAnimal($y) {
        return $this->Animals[($y - 4) % 12];
    }

    /**
     * 传入阳历年月日获得详细的公历、农历object信息 <=>JSON
     * @param y  solar year //参数区间1900.1.31~2100.12.31
     * @param m  solar month
     * @param d  solar day
     * @return JSON object
     * @eg:console.log(calendar.solar2lunar(1987,11,01));
     */
    public function solar2lunar($y,$m,$d) {
        //年份限定、上限
        if($y<1900 || $y>2100) {return -1;}
        //校验月份
        if($m<1 || $m>12) {return -1;}
        //校验日期
        if($d<1 || $d>31) {return -1;}
        //公历传参最下限
        if($y == 1900 && $m == 1 && $d < 31) {return -1;}

        $temp=0;
        $offset = $this->getDiffDays($y,$m,$d);

        $offset -= 31;
        for($i=1900; $i<2101 && $offset>0; $i++) {
            $temp = $this->lYearDays($i);//农历年一整年的天数
            $offset -= $temp;
        }
        if($offset<0) {
            $offset += $temp; $i--;
        }

        //农历年
        $year = $i;
        $leap = $this->leapMonth($i); //闰哪个月
        $isLeap = false;

        //效验闰月
        for($i=1; $i<13 && $offset>0; $i++) {
            //闰月
            if($leap>0 && $i==($leap+1) && $isLeap==false){
                --$i;
                $isLeap = true;
                $temp = $this->leapDays($year); //计算农历闰月天数
            }else{
                $temp = $this->monthDays($year, $i);//计算农历普通月天数
            }
            //解除闰月
            if($isLeap==true && $i==($leap+1)) { $isLeap = false; }
            $offset -= $temp;
        }

        // 闰月导致数组下标重叠取反
        if($offset==0 && $leap>0 && $i==$leap+1){
            if($isLeap){
                $isLeap = false;
            }else{
                $isLeap = true; --$i;
            }
        }
        if($offset<0){
            $offset += $temp; --$i;
        }

        //农历月
        $month = $i;
        //农历日
        $day = $offset + 1;
        //天干地支处理 这里需要处理一下，以“立春”为界
        $liChun  = $this->getTerm($y,(3));//返回当年立春日
        if ($m<2 || ($m==2 && $d<$liChun)){
            $gzY = $this->toGanZhiYear($y-1);//因为农历年始终是滞后于公历年的，所以为了简化逻辑，此处直接用公历年-1了
            $gzYnum = $y-1;
        }else{
            $gzY = $this->toGanZhiYear($year);
            $gzYnum = $year;
        }

        // 当月的两个节气
        // bugfix-2017-7-24 11:03:38 use lunar Year Param `y` Not `year`
        $firstNode  = $this->getTerm($y,($m*2-1));//返回当月「节」为几日开始
        $secondNode = $this->getTerm($y,($m*2));//返回当月「气」为几日开始

        // 依据12节气修正干支月
        $gzM = $this->toGanZhi(($y-1900)*12+$m+11);
        $gzMnum = $month-1;
        if($d >= $firstNode) {
            $gzM = $this->toGanZhi(($y-1900)*12+$m+12);
            $gzMnum = $month;
        }

        //传入的日期的节气与否
        $isTerm = false;
        $Term   = null;
        if($firstNode==$d) {
            $isTerm  = true;
            $Term    = $this->solarTerm[$m*2-2];
        }
        if($secondNode==$d) {
            $isTerm  = true;
            $Term    = $this->solarTerm[$m*2-1];
        }
        
        $dayCyclical = $this->getDiffDays($y,$m,$d)+9;
        $gzD         = $this->toGanZhi($dayCyclical);

        return ['lYear'=>$year,'lMonth'=>$month,'lDay'=>$day,'Animal'=>$this->getAnimal($year),'cYear'=>$y,'cMonth'=>$m,'cDay'=>$d,'gzYear'=>$gzY,'gzMonth'=>$gzM,'gzDay'=>$gzD,'gzYnum'=>$gzYnum,'gzMnum'=>$gzMnum,'isLeap'=>$isLeap,'isTerm'=>$isTerm,'Term'=>$Term];
    }

    //还是自己写的比较靠谱
    public function getDiffDays($y,$m,$d){
        $y_days = ($y-1900)*365+floor(($y-1900)/4);
        if ($m>1){
            $m_days = array_sum(array_slice($this->solarMonth,0,$m-1));
        }else{
            $m_days = 0;
        }
        if ($y%4 == 0){
            $y_days -= 1;//如果刚好是闰年，则先减去当年闰的那一天
            if (($m>2)){
                $m_days += 1;//闰年过了二月要加一天
            }
        }
        return (int)$y_days+$m_days+$d;
    }

    //param $sort 1下一个 2上一个
    public function getNearJieQi($y,$m,$d,$sort=1){
        $next_m = ($m<12)?$m+1:1;
        $next_y = ($m<12)?$y:$y+1;
        $prev_m = ($m>1)?$m-1:12;
        $prev_y = ($m>1)?$y:$y-1;
        $nowNode  = $this->getTerm($y,($m*2-1));
        $nextNode  = $this->getTerm($next_y,($next_m*2-1));
        $prevNode  = $this->getTerm($prev_y,($prev_m*2-1));
        if ($sort == 1){
            if ($d > $nowNode){
                $node = [$next_y,$next_m,$nextNode];
            }else{
                $node = [$y,$m,$nowNode];
            }
        }elseif ($sort == 2){
            if ($d < $nowNode){
                $node = [$prev_y,$prev_m,$prevNode];
            }else{
                $node = [$y,$m,$nowNode];
            }
        }
        $a = $this->getDiffDays($y, $m, $d);
        $b = $this->getDiffDays($node[0], $node[1], $node[2]);
        return abs($a-$b);
    }    
}