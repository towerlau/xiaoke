<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <title>我的课时中心</title>
</head>

<body>

    <div class="main" id="userCenter">
        <div class="banner">
            <div>
                {{Pos}}
            </div>
            <div>
                <div class="temp">
                    <span class="tempNum">{{nowTemp}}</span><span class="tempDu" v-if="Pos">℃</span>
                </div>
                <div class="weatherDe">
                    <span class="aqis">{{aqis}}</span>
                    <span class="weather">{{weather}}</span>
                    <span class="tempArr">{{tempArr}}</span>
                </div>
            </div>
        </div>
        <div class='lineList'>
            <div class='line'>
                <div class='lineCell'>张三，你好！</div>
                <div class='lineCell textAlignR centerTime' id="time" style="flex:2;"></div>
            </div>
        </div>
        <div class="gap lineList">
            <div class="line borderBottom">
                <div class="lineCell">
                    lksjdl
                </div>
                <div class="lineCell">
                    eee
                </div>
            </div>
            <div class="line borderBottom">
                <div class="lineCell">lksjdl</div>
                <div class="lineCell">eee</div>
            </div>
        </div>
        <div class="menu gap">
            <div class="line">
                <div><span>图标</span><span>个人资料</span></div>
                <div><span>图标</span><span>学生信息</span></div>
                <div><span>图标</span><span>课时信息</span></div>
                <div><span>图标</span><span>课 程 表</span></div>
            </div>
            <div class="line">
                <div>dispatch</div>
                <div>scopedSlots</div>
                <div>getters</div>
                <div></div>
            </div>
            <div class="line">
                <div>@leave-cancelled</div>
                <div>watch</div>
                <div></div>
                <div id='test'></div>
            </div>
        </div>
    </div>
    <version>
        lskdlsajldfsldflskdjfkkkldkf version:1.0.0.1
    </version>
</body>
<script>
    function getTime() {
        var date = new Date();
        weekD = '日一二三四五六';
        str = date.getFullYear() + '年' + add0(date.getMonth() + 1) + '月' + add0(date.getDate()) + '日 ';
        str += add0(date.getHours()) + ":" + add0(date.getMinutes()) + ":" + add0(date.getSeconds()) + ' ' + weekD[date.getDay()];
        $("#time").text(str);
    }

    function add0(data) {
        if (parseInt(data) < 10) return '0' + data;
        else return data;
    }
    $("#test").on('click', function(e) {
        update_b();
        var win = document.getElementById('weather').contentWindow;
        alert(win.document.body.innerText);

    })
    var userCenter = new Vue({
        el: '#userCenter',
        data: {
            Pos: '',
            aqis: '',
            weather: '',
            tempArr: '',
            nowTemp: '',
            aqiDj: [50, 100, 150, 200, 300, 500],
            aqiDjN: ['6BCD07', 'FBD029', 'FE8802', 'FE0000', '970454', '62001E'],
            aqiDjName: ['优', '良', '轻度污染', '中度污染', '重度污染', '没法活了'],
        },
        methods: {
            getData: function() {
                var weather;
                _self = this;
                $.get('http://weixin.jirengu.com/weather', function(result, status) {
                    if (status == 'success') {
                        if (result.status == 'error') {
                            _self1 = _self;
                            $.get('http://api.jirengu.com/weather.php', function(result, status) {
                                result = eval('(' + result + ')');
                                if (status == 'success') {
                                    if (result.status != 'error') {
                                        _self1.Pos = result.results[0].currentCity;
                                        aqi = result.results["0"].pm25;
                                        i = -1;
                                        _self1.aqiDj.forEach((element, k) => {
                                            if (parseInt(aqi) >= element) i = k;
                                            else return;
                                        });
                                        _self1.aqis = _self1.aqiDjName[i + 1];
                                        color1 = "#" + _self1.aqiDjN[i + 1];
                                        $(".aqis").css({
                                            background: color1
                                        });
                                        _self1.weather = result.results[0].weather_data[0].weather;
                                        datestr = result.results[0].weather_data[0].date;
                                        datestr = datestr.substring(datestr.indexOf('：') + 1, datestr.length - 2);
                                        _self1.nowTemp = datestr;
                                        _self1.tempArr = result.results[0].weather_data[0].temperature;
                                    }
                                }
                            });

                            return;
                        }
                        _self.Pos = result.weather[0].city_name;
                        _self.aqis = result.weather[0].now.air_quality.city.quality;
                        aqi = result.weather[0].now.air_quality.city.aqi;
                        i = -1;
                        _self.aqiDj.forEach((element, k) => {
                            if (parseInt(aqi) >= element) i = k;
                            else return;
                        });
                        color1 = "#" + _self.aqiDjN[i + 1];
                        $(".aqis").css({
                            background: color1
                        });
                        _self.weather = result.weather[0].now.text;
                        _self.nowTemp = result.weather[0].now.temperature;
                        _self.tempArr = result.weather[0].future[0].low + '℃~' + result.weather[0].future[0].high + '℃';
                    }

                });
            }
        },
    })
    userCenter.getData();

    // $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function() {
    //     // alert(remote_ip_info.country); //国家  
    //     // alert(remote_ip_info.province); //省份  
    //     city = remote_ip_info.city; //城市  

    //     // $.getScript('http://www.sojson.com/open/api/weather/json.shtml?city=' + city, function() {
    //     //     console.log('remote_ip_info');

    //     // });
    // });
    window.onload = function() {
        getTime();
        setInterval("getTime()", 1000);





        return;
        document.addEventListener('touchstart', function(event) {
            if (event.touches.length > 1) {
                event.preventDefault();
            }
        })
        var lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            var now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false)
    }
</script>

</html>