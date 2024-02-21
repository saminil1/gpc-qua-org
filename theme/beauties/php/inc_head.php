
            <h1>GPC인증신청시스템 lOGIN 페이지만들기 </h1><br>
            <h2>PHP $_SESSION을 이용하여, 로그인, 로그아웃 만들기, 로그인 사용자만 볼 수 있는 콘텐츠 만들기</h2>

            <?php
            //모든 페이지에 들어갈 코이이다.
            //include  함수이며, 각 페이지에서 불어올 것이다.
            //세션에 username 값이 있다면, 즉 로그인 상태라면 $jb_login에 TRUE를 할당한다.
            ?>
            <?php
            session_start();
            if( isset( $_SESSION[ 'username' ] ) ) {
                $jb_login = TRUE;
            }
            ?>



