<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 10:36
 */
return [
    'app_name' => 'Automotive Parts',
    'homepage' => 'Trang chủ',
    'accessary' => [
        'type' => 'Loại phụ tùng',
        'genuine' => 'Phụ tùng chính hãng',
        'oem' => 'Phụ tùng OEM',
        'options' => 'Phụ tùng thay thế ngoài',
        'main' => 'Phụ tùng chính hãng',
        'code' => 'Mã phụ tùng',
        'name' => 'Tên phụ tùng',
        'trademark' => 'Thương hiệu',
        'acronym_name' => 'Tên viết tắt',
        'unsigned_name' => 'Tên không dấu',
        'photo_top' => 'Ảnh chụp trên',
        'photo_bottom' => 'Ảnh chụp dưới',
        'photo_left' => 'Ảnh chụp trái',
        'photo_right' => 'Ảnh chụp phải',
        'photo_inner' => 'Ảnh chụp trong',
        'photo_outer' => 'Ảnh chụp ngoài',
        'accessary_link' => 'Phụ tùng liên kết',
        'prioritize' => 'Ưu tiên',
        'price' => 'Giá bán'
    ],
    'car' => [
        'management' => 'Quản lý thông tin xe',
        'brand' => 'Hãng xe',
        'catalog' => 'Dòng xe',
        'grade' => 'Mẫu xe',
        'name' => 'Tên xe',
        'num_of_doors' => 'Số cửa',
        'car_manufacturer' => 'Nhà sản xuất',
        'factory' => 'Nhà máy sản xuất',
        'year' => 'Năm sản xuất',
        'motion_system' => 'Hệ thống truyền động',
        'parts' => 'Bộ phận xe'
    ],
    'car_brand' => [
        'code' => 'Mã hãng xe',
        'name' => 'Tên hãng xe',
        'nation' => 'Quốc gia',
    ],
    'catalog_car' => [
        'brand' => 'Hãng xe',
        'name' => 'Tên dòng xe'
    ],
    'catalog_parts' => [
        'parent_id' => 'Nhóm cha',
        'name' => 'Tên nhóm bộ phận xe'
    ],
    'parts' => [
        'management' => 'Quản lý thông tin bộ phận xe',
        'catalog' => 'Nhóm bộ phận xe',
        'title' => 'Bộ phận xe',
        'code' => 'Mã bộ phận xe',
        'name' => 'Tên bộ phận xe',
        'width' => 'Chiều rộng',
        'height' => 'Chiều dài',
        'number_of_tooth' => 'Số răng',
        'inner_diameter' => 'Đường kính trong',
        'outer_diameter' => 'Đường kính ngoài',
        'torque' => 'Mô men xoắn',
        'life_cycle' => 'Tuổi thọ',
        'weight' => 'Khối lượng',
        'liquor' => 'Dung dịch sử dụng',
        'accessary' => 'Phụ tùng'
    ],
    'nation' => [
        'management' => 'Quản lý thông tin quốc gia',
        'code' => 'Mã quốc gia',
        'name' => 'Tên quốc gia',
        'name_vi' => 'Tên tiếng Việt',
        'name_en' => 'Tên tiếng Anh'
    ],
    'trade_mark' => [
        'management' => 'Quản lý thông tin thương hiệu',
        'code' => 'Mã thương hiệu',
        'name' => 'Tên thương hiệu'
    ],
    'common' => [
        'icon' => 'Icon',
        'user' => 'Nhà cung cấp',
        'quantity' => 'Số lượng hiện có',
        'garage_price' => 'Giá bán garage',
        'retail_price' => 'Giá bán lẻ',
        'technique_picture' => 'Ảnh kỹ thuật',
        'nation' => 'Quốc gia',
        'num_of_row' => '#',
        'description' => 'Mô tả',
        'status' => 'Trạng thái',
        'action' => 'Tác vụ',
        'input' => 'Nhập',
        'choose' => 'Chọn',
        'status_active' => 'Sử dụng',
        'status_inactive' => 'Không sử dụng',
        'status_approve' => 'Đã duyệt',
        'status_reject' => 'Đã từ chối',
        'status_pending' => 'Chờ duyệt',
        'success' => 'Thực hiện thành công!',
        'error' => 'Đã có lỗi, vui lòng thử lại.',
        'confirm' => 'Bạn có chắc chắn?',
        'required' => 'Vui lòng nhập thông tin.',
        'dont_have_permission' => 'Bạn không có quyền thực hiện chức năng này!.',
        'created_at' => 'Ngày tạo',
        'approve_at' => 'Ngày phê duyệt',
        'reject_at' => 'Ngày từ chối'
    ],
    'button' => [
        'create' => 'Thêm mới',
        'cancel' => 'Hủy',
        'save' => 'Lưu lại',
        'edit' => 'Cập nhật',
        'delete' => 'Xóa',
        'approve' => 'Duyệt',
        'reject' => 'Từ chối',
	'change-pass' => 'Thay đổi mật khẩu'
    ],
    'account' => [
        'role' => 'Quyền',
        'user' => 'Tài khoản',
        'role_name' => 'Tên',
        'description' => 'Mô tả',
        'no' => 'STT',
        'update' => 'Thêm mới/Cập nhật thông tin',
        'enter_user_name' => 'Nhập tên',
        'enter_description' => 'Nhập mô tả',
        'user_name' => 'Họ tên',
        'birth_day' => 'Ngày sinh',
        'gender' => 'Giới tính',
        'phone' => 'SĐT',
        'email' => 'Email',
        'address' => 'Địa chỉ',
        'id_card' => 'CMND/CC',
        'drving_license' => 'Số GPLX',
        'fax' => 'Fax',
        'role' => 'Quyền',
        'code' => 'Tên viết tắt',
        'user_type' => 'Loại tài khoản',
        'avatar'=>'Ảnh đại diện',
        'enter_address' => 'Nhập địa chỉ',
        'enter_dob' => 'Nhập ngày sinh',
        'enter_driving_license' => 'Nhập số GPLX',
        'enter_id_card' => 'Nhập số CMND/Căn cước',
        'enter_fax' => 'Nhập số Fax',
        'enter_code' => 'Nhập tên viết tắt',
        'enter_phone' => 'Nhập số điện thoại',
        'enter_email' => 'Nhập địa chỉ email',
        'enter_old_pass' => 'Nhập mật khẩu cũ',
        'enter_new_pass' => 'Nhập mật khẩu mới',
        'confirm_new_pass' => 'Nhập lại mật khẩu',
        'old_pass' => 'Mật khẩu cũ',
        'new_pass' => 'Mật khẩu mới',
        're_new_pass' => 'Nhập lại mật khẩu'

    ],
    'user' => [
        'code' => 'Mã NCC',
        'name' => 'Tên NCC'
    ],
    'quotation' => [
        'code' => 'Mã báo giá'
    ],
    'route' => [
        'car-management' => 'Quản lý thông tin xe',
        'account-management' => 'Quản lý tài khoản',
	    'add-role' => 'Thêm mới Quyền',
        'edit-role' => 'Cập nhật Quyền',
        'nation-management' => 'Quản lý thông tin quốc gia',
        'trademark-management' => 'Quản lý thông tin thương hiệu',
        'parts-management'=> 'Quản lý thông tin bộ phận xe',
        'price-management' => 'Quản lý giá phụ tùng',
        'temp-price-management' => 'Quản lý yêu cầu thêm phụ tùng',
        'accessary-management' => 'Quản lý thông tin phụ tùng',
        'quotation-management' => 'Quản lý báo giá',
        'quotation-create' => 'Thêm mới báo giá',
        'accessary-create' => 'Thêm mới thông tin phụ tùng',
        'accessary-edit' => 'Cập nhật thông tin phụ tùng',
	'view_profile' => 'Trang thông tin cá nhân'
    ],
    'form' => [
        'create' => 'Thêm mới',
        'update' => 'Cập nhật',
        'approve' => 'Phê duyệt',
        'trash' => 'Gỡ bỏ',
        'browser' => 'Duyệt',
        'change' => 'Thay đổi'
    ]
];
