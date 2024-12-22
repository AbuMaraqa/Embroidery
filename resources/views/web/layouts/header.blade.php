<div class="bg-light">
    <div class="container">
        <div class="row w-100 p-3 justify-content-center align-items-center justify-items-center">
            <div class="col-md-3">
                <a href="{{ route('home')}}">
                    <img style="width: 100px" src="{{ asset('img/logo.png')}}" alt="">
                </a>
            </div>
            <form class="col-md-6 d-flex" method="post" action="{{ route('home.search') }}">
                @csrf
                <input type="text" name="search" class="form-control" placeholder="بحث">
                <button type="submit" class="btn btn-primary">بحث</button>
            </form>
            <div class="col-md-3 text-end d-flex justify-content-end align-items-center">
                <a href="{{ route('cart.getCart') }}" style="font-size: 20px" class="fa fa-shopping-cart text-dark pe-4"></a>
                <li class="nav-item dropdown" style="list-style-type:none;">
                    <span href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"  style="font-size: 20px" class="fa fa-user nav-link"></span>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (Auth::check())
                            <li><a class="dropdown-item" href="#">{{ auth()->user()->name }}</a></li>
                            @if (auth()->user()->user_role == 'embroider')
                                <p class="text-center alert alert-success " style="font-size: 10px">الرصيد الخاص بي : <span>{{ auth()->user()->amount }}</span> شيكل</p>
                                <li><a class="dropdown-item" href="{{ route('web.profile.profile',['id'=>auth()->user()->id])}}">المعلومات الشخصية</a></li>
                                <li><a class="dropdown-item" href="{{ route('web.message.list_message',['id'=>auth()->user()->id])}}">الرسائل الواردة</a></li>
                            @endif
                            @if (auth()->user()->user_role == 'client')
                            <li><a class="dropdown-item" href="{{ route('web.profile.profile',['id'=>auth()->user()->id])}}">المعلومات الشخصية</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.my_orders')}}">الطلبيات الخاص بي</a></li>
                            <li><a class="dropdown-item" href="{{ route('web.embroidery.new_embroidery')}}">طلب تطريز</a></li>
                            <li><a class="dropdown-item" href="{{ route('web.embroidery_request.embroidery_request_index')}}">الطلبات الخاصة بالمنشورات</a></li>
                            @endif
                            <li><a class="dropdown-item text-danger" href="{{ route('logout')}}">تسجيل الخروج</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login')}}">تسجيل الدخول</a></li>
                        @endif
                    </ul>
                </li>
            </div>
        </div>
        <div class="row p-3 justify-content-center align-items-center">
            @foreach ($category as $key)
                <div class="col-1">
                    <li class="nav-item dropdown" style="list-style-type:none;">
                        <a class="nav-link" href="{{ route('category.index', ['id'=>$key->id])}}">
                            {{ $key->category_name }}
                        </a>
                        {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul> --}}
                    </li>
                </div>
            @endforeach
        </div>
</div>
</div>
