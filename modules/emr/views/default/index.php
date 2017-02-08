<?php

use yii\helpers\Url;
?>

<script>
    function getListDetail(hos, hn, vn) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            url: "<?php echo Url::to(['listcharge/historychargedetail']); ?>?table=" + hos + "&hn=" + hn + "&vn=" + vn,
            success: function (data) {
                $.each(data, function (k, v) {
                    console.log(k + " -> " + v);
                    $('#jr_' + k).html(v);
                });
                $('#panel-service').show();
                //$('#dataDiag').html('ยังไม่มีการเลือก visit...');
                getListDiag();
                $('#dataDrug').html('ยังไม่มีการเลือก visit...');
            }
        });
    }

    function getListPerson() {
        $('#dataPerson').html('กำลังค้นหาข้อมูล...');
        $('#dataCharge').html('รอการเลือกแสดงข้อมูล...');

        $('#panel-person').hide();
        $('#panel-service').hide();

        $.ajax({
            type: "POST",
            data: {'jx_search': $('#jx_search').val()},
            url: "<?php echo Url::to(['listcharge/listperson']); ?>",
            success: function (data) {
                $('#dataPerson').html(data);
            }
        });
    }

    function getListDiag() {
        $('#dataDiag').html('กำลังค้นหาข้อมูล...');
        var vn = $('#jr_vn').html();
        var table = $('#jr_hospcode').html();
        if (table != '' && vn != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo Url::to(['listcharge/listdiag']); ?>?table=" + table + "&vn=" + vn,
                success: function (data) {
                    $('#dataDiag').html(data);
                }
            });
        } else {
            $('#dataDiag').html('ยังไม่มีการเลือก visit...');
        }

    }
    function getListLab() {
        $('#dataLab').html('กำลังค้นหาข้อมูล...');
        var vn = $('#jr_vn').html();
        var table = $('#jr_hospcode').html();
        if (table != '' && vn != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo Url::to(['listcharge/listlab']); ?>?table=" + table + "&vn=" + vn,
                success: function (data) {
                    $('#dataLab').html(data);
                }
            });
        } else {
            $('#dataLab').html('ยังไม่มีการเลือก visit...');
        }

    }
    function getListDrug() {
        $('#dataDrug').html('กำลังค้นหาข้อมูล...');
        var vn = $('#jr_vn').html();
        var table = $('#jr_hospcode').html();
        if (table != '' && vn != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo Url::to(['listcharge/listdrug']); ?>?table=" + table + "&vn=" + vn,
                success: function (data) {
                    $('#dataDrug').html(data);
                }
            });
        } else {
            $('#dataDrug').html('ยังไม่มีการเลือก visit...');
        }
    }

    function getListProced() {
        $('#dataDrug').html('กำลังค้นหาข้อมูล...');
        var vn = $('#jr_vn').html();
        var table = $('#jr_hospcode').html();
        if (table != '' && vn != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo Url::to(['listcharge/listproced']); ?>?table=" + table + "&vn=" + vn,
                success: function (data) {
                    $('#dataProced').html(data);
                }
            });
        } else {
            $('#dataProced').html('ยังไม่มีการเลือก visit...');
        }
    }

    function getListCharge(cid) {
        $('#dataCharge').html('กำลังค้นหาข้อมูล...');
        $('#panel-service').hide();
        $.ajax({
            type: "POST",
            data: {'cid': cid},
            url: "<?php echo Url::to(['listcharge/historycharge']); ?>",
            success: function (data) {
                $('#dataCharge').html(data);
            }
        });
        /*
         $.ajax({
         type: "POST",
         data: {'cid': $('#cid').val()},
         url: "<?php echo Url::to("listcharge/historylab"); ?>",
         error: function () {
         alert("some error occurred")
         },
         success: function (data) {
         $('#dataLab').html(data);
         }
         });

         $.ajax({
         type: "POST",
         data: {'cid': $('#cid').val()},
         url: "<?php echo Url::to("listcharge/historydrug"); ?>",
         error: function () {
         alert("some error occurred")
         },
         success: function (data) {
         $('#dataDrug').html(data);
         }
         });

         */
    }
    function getListPersonDetail(table, cid) {
        getListCharge(cid);
        $.ajax({
            type: "POST",
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            url: "<?php echo Url::to(['listcharge/listpersondetail']); ?>?table=" + table + "&cid=" + cid,
            success: function (data) {
                $.each(data, function (k, v) {
                    if (k == 'image') {
                        if (v != '') {
                            var $img = $("<img/>");
                            $img.attr("width", "200px");
                            $img.attr("src", "data:image/png;base64," + v);
                            $('#jrp_' + k).html($img);
                        } else {
                            $('#jrp_' + k).html('ไม่พบข้อมูล');
                        }
                    } else {
                        $('#jrp_' + k).html(v);
                    }
                });
                $('#panel-person').show();
            }
        });
    }

</script>
<div class="row">
    <div class="col-lg-12 small">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Electronic medical record system</h3>
            </div>
            <div class="panel-body">
                <form class="form-inline rows">
                    <div class="form-group">
                        <label>ค้นหา</label>
                        <input type="text" class="form-control input-sm"  id="jx_search" placeholder="ชื่อ-สกุล/เลขบัตรประชาชน">
                        <button class="btn btn-danger btn-sm" type="button"  onclick="getListPerson();">ค้นหา</button>
                    </div>
                    <hr>
                    <div class="row text-center" id="dataPerson"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 small">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">ข้อมูลการให้บริการ</h3>
            </div>
            <div class="panel-body">
                <div class="row text-center" id="dataCharge">
                    รอการเลือกแสดงข้อมูล...
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">แฟ้มข้อมูลเวชระเบียน</h3>
            </div>
            <div class="panel-body"  id="panel-person">
                <form class="small form-inline">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label>เลขบัตรประชาชน</label>
                                    <b><span id="jrp_cid">-</span></b>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label>ชื่อ-สกุล</label>
                                    <b><span id="jrp_fullname">-</span></b>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>HN</label>
                                    <b><span id="jrp_hn">-</span></b>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>ที่อยู่</label>
                                    <b><span id="jrp_address">-</span></b>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label>วันเดือนปีเกิด</label>
                                    <b><span id="jrp_birthdate">-</span></b>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>อายุ</label>
                                    <b><span id="jrp_age">-</span></b>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>สถานะการอยู่อาศัย</label>
                                    <b><span id="jrp_typearea">-</span></b>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>แผนที่</label>
                                    <b><span id="jrp_latitude">-</span></b>/<b><span id="jrp_longitude">-</span></b>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <a href="#" class="thumbnail">
                                    <span id="jrp_image"></span>
                                </a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">แฟ้มข้อมูลการรักษา</h3>
            </div>
            <div class="panel-body" id="panel-service">
                <form class="small form-inline">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label>วันที่มา</label>
                            <b><span id="jr_vstdate">-</span></b>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>เวลา</label>
                            <b><span id="jr_vsttime">-</span></b>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>เวร</label>
                            <b><span>-</span></b>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>VN</label>
                            <b><span id="jr_vn"></span></b>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>สถานบริการที่ให้บริการ</label>
                            <b><span id="jr_hospcode"></span> <span id="jr_hname"></span></b>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>สิทธิการรักษา</label>
                            <b><span id="jr_ptname">-</span></b>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>แพทย์ผู้ตรวจ</label>
                            <b><span id="jr_dcname">-</span></b>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>การวินิจฉัยหลัก</label>
                            <b><span id="jr_pdx_name">-</span></b>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>การแพ้ยา</label>
                            <b><span>-</span></b>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>โรคประจำตัว</label>
                            <b><span>-</span></b>
                        </div>

                    </div>
                </form>

                <hr>
                <h4>รายละเอียด</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#diag" data-toggle="tab"  onclick="getListDiag();">การวินิจฉัยโรค</a></li>
                            <li class=""><a href="#drug" data-toggle="tab"  onclick="getListDrug();">การรับยา</a></li>
                            <li class=""><a href="#proced" data-toggle="tab"  onclick="getListProced();">หัตถการ</a></li>
                            <li class=""><a href="#lab" data-toggle="tab"   onclick="getListLab();">Lab(เฉพาะ DMHT)</a></li>
                            <!--<li class=""><a href="#drug3" data-toggle="tab" >ส่งเสริมสุขภาพ</a></li>
                           <li class=""><a href="#drug4" data-toggle="tab" >ทันตกรรม</a></li>
                           <li class=""><a href="#drug5" data-toggle="tab" >แพทย์แผนไทย</a></li>
                            -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="diag">
                                <div class="text-center" id="dataDiag">
                                    รอการเลือกแสดงข้อมูล...
                                </div>
                            </div>
                            <div class="tab-pane" id="drug">
                                <div class="text-center" id="dataDrug">
                                    รอการเลือกแสดงข้อมูล...
                                </div>
                            </div>
                            <div class="tab-pane" id="proced">
                                <div class="text-center" id="dataProced">
                                    รอการเลือกแสดงข้อมูล...
                                </div>
                            </div>
                            <div class="tab-pane" id="lab">
                                <div class="text-center" id="dataLab">
                                    รอการเลือกแสดงข้อมูล...
                                </div>
                            </div>
                            <div class="tab-pane" id="drug4">
                                <div class="text-center" id="dataDrug1">
                                    รอการเลือกแสดงข้อมูล...
                                </div>
                            </div>
                            <div class="tab-pane" id="drug5">
                                <div class="text-center" id="dataDrug1">
                                    รอการเลือกแสดงข้อมูล...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#panel-person').hide();
        $('#panel-service').hide();

        $(".panel").tabs({
            //event: "mouseover"
        });

    });

</script>