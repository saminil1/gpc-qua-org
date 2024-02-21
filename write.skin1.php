<!--# 우편번호 / 주소검색 입력-->

<!--그누보드5 / skin / board / 폴더 / write.skin.php 추가-->

<div class="bo_w_tit write_div">
    <label for="addr" class="sound_only">주소<strong>필수</strong></label>
    <div id="write_div">
        <input size="7" name="wr_1" id="postcode" itemname="우편번호" readonly value="<?php echo $write['wr_1']; ?>">
        <button type="button" class="btn_frmline" onclick="openDaumPostcode();">주소 검색</button><br>
        <input name="wr_2" id="addr" type="text" size="60" value="<?php echo $write['wr_2']; ?>" readonly><br />
        <input name="wr_3" id="addr2" type="text" size="60" value="<?php echo $write['wr_3']; ?>">
    </div>
    <?php if($_SERVER['HTTPS'] === "on"){ ?><script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <?php } else { ?><script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script><?php } ?>
    <script>
        function openDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullAddr = ''; // 최종 주소 변수
                    var extraAddr = ''; // 조합형 주소 변수

                    // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        fullAddr = data.roadAddress;

                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        fullAddr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                    if(data.userSelectedType === 'R'){
                        //법정동명이 있을 경우 추가한다.
                        if(data.bname !== ''){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있을 경우 추가한다.
                        if(data.buildingName !== ''){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                        fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('postcode').value = data.zonecode; //5자리 새우편번호 사용
                    document.getElementById('addr1').value = fullAddr;

                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById('addr2').focus();
                }
            }).open();
        }
    </script>
</div>