Hi {{ $data['name']}},
Bạn có lời mời tham gia lớp học. 
Click <a href="{{ route('gv-xl-tham-gia',['id' => $data['id'], 'lop_id' => $data['lop_hoc_id']] ) }}">vào đây</a> để tham gia.