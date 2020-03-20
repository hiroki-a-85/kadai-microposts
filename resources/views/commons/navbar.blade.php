<header class="mb-4">
    
    <!-- Bootstrapナビゲーションバー -->
    <!-- nav要素を使う、classにnavbarとnavbar-expand -->
    <!-- navbar-expand-[サイズ]で、画面幅以下でメニューを非表示 -->
    <!-- navbar-dark/lightで暗めか明るめか、bg-[色の種類]で背景色を指定-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        <!-- サイト名にリンクを設定、classにnavbar-brandを指定しておく -->
        <a class="navbar-brand" href="/">Microposts</a>
        
        <!-- 指定画面幅以下の時の折り畳み時に表示する、3本線のボタンを用意 -->
        <!-- サイト名のリンクの直後に書くと左側に表示される -->
        <!-- data-target="#nav-bar"は、collapse(折りたたむ)する対象の、id="nav-bar"とリンクしている -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- 折りたたむ対象の要素 -->
        <!-- div要素で囲み、classにcollapseとnavbar-collapseを指定する -->
        <div class="collapse navbar-collapse" id="nav-bar">
            
            <!-- <ul class="navbar-nav mr-auto"></ul>と一つ空のul要素を記述 -->
            <!-- これにより2つ目のul要素のli要素がナビゲーションバーの右側に表示される -->
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                
                <!-- Auth::check() -->
                <!-- ユーザーがログインしているかどうかを調べる関数-->
                @if (Auth::check())
                    <li class="nav-item"><a href="#" class="nav-link">Users</a></li>
                    
                    <!-- ドロップダウンメニュー -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item"><a href="#">My profile</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>