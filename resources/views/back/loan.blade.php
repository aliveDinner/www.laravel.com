<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="Site">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>房贷计算器</title>

    <!-- Fonts -->
    <link href="https://www.laravel.com/views/css/layout.css" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif !important;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .font-raleway {
            font-family: 'Raleway', sans-serif;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .item-box {
            width: 480px;
            margin: 20px 0px;
        }

        .item {
            overflow: hidden;
            width: 480px;
            padding: 10px;
        }

        .item + .item {
            border-top: 1px solid #cccccc;
        }

        .item .left {
            float: left;
        }

        .item .right {
            float: right;
        }

        .item .right .right-item [type="number"] {
            width: 140px;
            text-align: right;
            padding: 0 0 0 10px;
        }

    </style>

    <!-- Load Bootstrap CSS -->
    <!--<link href="https://www.laravel.com/views/components/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">-->
    <link href="https://www.laravel.com/views/css/app.css" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height" ng-controller="SiteController">

    <div>
        <div class="item-box">
            <div class="item back-way">
                <label for="" class="left">还款方式</label>
                <span class="right">
                    <span class="right-item"><input type="radio" name="repayment" value="1" title="等额本息"
                                                    ng-model="data.repayment"
                                                    ng-selected="1==data.repayment"/>等额本息</span>
                    <span class="right-item"><input type="radio" name="repayment" value="2" title="等额本金"
                                                    ng-model="data.repayment"
                                                    ng-selected="2==data.repayment"/>等额本金</span>
                </span>
            </div>
            <div class="item total">
                <label for="" class="left">房贷总额</label>
                <span class="right">
                        <span class="right-item"><input type="number" name="total" value="" placeholder="请输入房款总额"
                                                        ng-model="data.total"/>万元</span>
                    </span>
            </div>
            <div class="item total">
                <label for="" class="left">首付金额</label>
                <span class="right">
                    <span class="right-item">
                        <select name="perPayment" ng-model="perPaymentSel">
                            <option ng-repeat="(key,value) in perSelection" value="@{{key}}"
                                    ng-selected="key == perPaymentSel">@{{value}}</option>
                        </select>
                    </span>
                    <span class="right-item"><input type="number" name="payment" value="" placeholder="请输入首付金额"
                                                    ng-model="payment"/>万元</span>
                </span>
            </div>
            <div class="item total">
                <label for="" class="left">贷款总额</label>
                <span class="right">
                    <span class="right-item"><input type="number" name="loanTotal" value="" placeholder="请输入贷款总额"
                                                    ng-model="loanTotal"/>万元</span>
                </span>
            </div>
        </div>

        <div class="item-box">
            <div class="item total">
                <label for="" class="left">商业贷款</label>
                <span class="right">
                    <span class="right-item"><input type="number" name="totalBus" value="" placeholder="请输入商业贷款"
                                                    ng-model="busTotal"/>万元</span>
                </span>
            </div>
            <div class="item total">
                <label for="" class="left">商业贷款利率</label>
                <span class="right">
                    <span class="right-item">
                         <select name="busPer" ng-model="data.busPer">
                             <option ng-repeat="(key,value) in perBusSelection" value="@{{key}}"
                                     ng-selected="key == data.busPer">@{{value}}</option>
                        </select>
                    </span>
                </span>
            </div>
            <div class="item total">
                <label for="" class="left">商业贷款年限</label>
                <span class="right">
                         <span class="right-item">
                        <select name="busPeriod" ng-model="data.busPeriod">
                            <option ng-repeat="(key,value) in periodBusSelection" value="@{{key}}"
                                    ng-selected="key == data.busPeriod">@{{key}}年(@{{value}}期)</option>
                        </select>
                    </span>
                    </span>
            </div>
        </div>

        <div class="item-box">
            <div class="item total">
                <label for="" class="left">公积金贷款</label>
                <span class="right">
                    <span class="right-item"><input type="number" name="totalFund" value="" placeholder="请输入公积金贷款"
                                                    ng-model="fundTotal"/>万元</span>
                </span>
            </div>
            <div class="item total">
                <label for="" class="left">公积金利率</label>
                <span class="right">
                        <span class="right-item">
                        <select name="fundPer" ng-model="data.fundPer">
                            <option ng-repeat="(key,value) in perFundSelection" value="@{{key}}"
                                    ng-selected="key == data.fundPer">@{{value}}</option>
                        </select>
                         </span>
                    </span>
            </div>
            <div class="item total">
                <label for="" class="left">公积金贷款年限</label>
                <span class="right">
                         <span class="right-item">
                             <select name="fundPeriod" ng-model="data.fundPeriod">
                                 <option ng-repeat="(key,value) in periodFundSelection" value="@{{key}}"
                                         ng-selected="key == data.fundPeriod">@{{key}}年(@{{value}}期)</option>
                            </select>
                    </span>
                    </span>
            </div>
        </div>

        <div class="item-box">
            <div class="item back-way">
                <label for="" class="left">是否使用公积金贷款</label>
                <span class="right">
                    <span class="right-item"><input type="radio" name="moreloan" value="1" title="否"
                                                    ng-model="data.moreloan" ng-selected="1==data.moreloan"/>否</span>
                    <span class="right-item"><input type="radio" name="moreloan" value="2" title="是"
                                                    ng-model="data.moreloan" ng-selected="2==data.moreloan"/>是</span>
                </span>
            </div>
        </div>

        <div class="item-box">
            <div class="item back-way">
                <p>每月还款： <span style="color: #bb00ff">@{{payMonth}}</span></p>
                <p>总计利息： <span style="color: #bb00ff">@{{payTotal}}</span></p>
            </div>
        </div>

        <div class="item-box">
            <div class="item back-way">
                <label class="btn btn-default">开始计算</label>
            </div>
        </div>

    </div>

</div>
<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="https://www.laravel.com/views/components/angular/angular.min.js"></script>
<script src="https://www.laravel.com/views/components/jquery-3.3.1/jquery.min.js"></script>
<script src="https://www.laravel.com/views/components/bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- AngularJS Application Scripts -->
<script src="https://www.laravel.com/views/js/helper.js"></script>
<script src="https://www.laravel.com/views/script/app.js"></script>
<script type="text/javascript">
    app.controller('SiteController', function ($scope) {

        var bus = {};
        for (var i = 1; i < 31; i++) {
            bus[i] = i * 12;
        }

        $scope.perSelection = {
            "10": "10%",
            "20": "20%",
            "30": "30%",
            "40": "40%",
            "50": "50%",
            "60": "60%",
            "70": "70%",
            "80": "80%",
            "90": "90%",
            "100": "100%"
        };

        $scope.perBusSelection = {
            "3430": "基准利率7折(3.43%)",
            "3765": "基准利率7.5折(3.675%)",
            "3920": "基准利率8折(3.920%)",
            "4165": "基准利率9折(4.165%)",
            "4410": "基准利率9.5折(4.410%)",
            "4900": "最新基准利率(4.9%)",
            "5390": "基准利率1.1倍(5.39%)",
            "5880": "基准利率1.2倍(5.88%)",
            "6370": "基准利率1.3倍(6.37%)"
        };
        $scope.periodBusSelection = bus;

        $scope.perFundSelection = {
            "3250": "最新基准利率(3.25%)",
            "3575": "最新基准利率1.1倍(3.575%)",
            "3900": "最新基准利率1.2倍(3.9%)",
            "4225": "最新基准利率1.3倍(4.225%)"
        };
        $scope.periodFundSelection = bus;

        $scope.data = {
            repayment: "1",//还款方式
            total: 0,//房贷总额
            payment: 30,//首付金额
            perPaymentSel: "30",//占比
            loanTotal: 30,//贷款总额
            busTotal: 0,//商业贷款
            busPer: "4900",//商业贷款利率
            busPeriod: "20",//商业贷款年限
            fundTotal: 0,//公积金贷款
            fundPer: "3250",//公积金利率
            fundPeriod: "20",//公积金贷款年限
            moreloan: "1"//是否公积金贷款
        };

        $scope.payTotal = 0;//共计利息
        $scope.payMonth = 0;//每月还款
        $scope.payment = 30;//首付金额
        $scope.perPaymentSel = '30';//占比
        $scope.loanTotal = 0;//贷款总额
        $scope.busTotal = 0;//商业贷款
        $scope.fundTotal = 0;//公积金贷款

        var setPayment = function (per) {
            if (per <= 0) {
                per = '30';
            }
            $scope.perPaymentSel = (isNaN(per) ? '30' : per).toString();
            $scope.payment = $scope.perPaymentSel * $scope.data.total / 100;
            $scope.loanTotal = (100 - $scope.perPaymentSel) * $scope.data.total / 100;//占比
            var year;
            if ($scope.data.moreloan == 1) {
                $scope.busTotal = $scope.loanTotal;//商业贷款
                year = $scope.data.busPeriod;
            } else {
                $scope.busTotal = $scope.loanTotal - $scope.fundTotal;//商业贷款
                year = $scope.data.fundPeriod;
            }
            //每月还款
            //等额本息
            var t = $scope.busTotal * 10000; //贷款本金
            var mp = $scope.data.busPer / 100000 / 12;//月利率
            var mt = year * 12;//还款月数
            //每月还款额=贷款本金×[月利率×(1+月利率) ^ 还款月数]÷{[(1+月利率) ^ 还款月数]-1}
            var payMonth = t>0 ? (t * mp * Math.pow((1 + mp),mt) / [Math.pow((1 + mp),mt) - 1]) : 0;
            //等额本金
            //每月月供额=(贷款本金÷还款月数)+(贷款本金-已归还本金累计额)×月利率
            //每月应还本金=贷款本金÷还款月数
            //每月应还利息=剩余本金×月利率=(贷款本金-已归还本金累计额)×月利率
            //每月月供递减额=每月应还本金×月利率=贷款本金÷还款月数×月利率
            //总利息=〔(总贷款额÷还款月数+总贷款额×月利率)+总贷款额÷还款月数×(1+月利率)〕÷2×还款月数-总贷款额
            //共计利息
            $scope.payMonth = payMonth.toFixed(2);
            var pay = (payMonth * mt).toFixed(2);
            $scope.payTotal = pay - t;
        };

        $scope.$watch('data.total', function (newValue, oldValue) {
            if (newValue < 0) {
                $scope.data.total = oldValue;
            }
            $scope.payment = $scope.perPaymentSel * $scope.data.total / 100;
            $scope.loanTotal = (100 - $scope.perPaymentSel) * $scope.data.total / 100;//占比
        });

        var t, k, l;
        $scope.$watch('payment', function (newValue, oldValue) {
            var per = newValue / $scope.data.total * 100;
            if (newValue > $scope.data.total) {
                setPayment(30);
                clearTimeout(t);
            } else if (per == 0) {
                setPayment(30);
                clearTimeout(t);
            } else if (per == 10 || per == 20 || per == 30 || per == 40 || per == 50 || per == 60 || per == 70 || per == 80 || per == 90 || per == 100) {
                setPayment(per);
                clearTimeout(t);
            } else {
                var top = '0';
                for (var i in $scope.perSelection) {
                    if (newValue <= i && newValue > top) {
                        per = i;
                        break;
                    } else {
                        top = i;
                    }
                }
                k = new Date().getTime();
                if ((k - l) <= 2000) {
                    clearTimeout(t);
                }
                l = k;
                t = setTimeout(function () {
                    setPayment(per);
                }, 2000);
            }
        });

        $scope.$watch('perPaymentSel', function (newValue, oldValue) {
            setPayment(newValue);
        });

        $scope.$watch('busTotal', function (newValue, oldValue) {
            if (newValue > $scope.data.total) {
                setPayment(30);
            } else {
                setPayment($scope.perPaymentSel);
            }
        });

        $scope.$watch('fundTotal', function (newValue, oldValue) {
            setPayment($scope.perPaymentSel);
        });

        $scope.$watch('data.moreloan', function (newValue, oldValue) {
            setPayment($scope.perPaymentSel);
        });

        //save new record / update existing record
        $scope.run = function (modalstate, id, key) {
        };
    })
    ;
</script>
</body>
</html>
