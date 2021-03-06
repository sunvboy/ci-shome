<?php 

if(!function_exists('mail_html')){
	function mail_html($param = NULL){
		$CI =& get_instance();
		// echo $param['payment_created'];die();
		$giaohang = date('Y-m-d', strtotime($param['payment_created']. ' + 3 days'));
        return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><div id="ht-order-email" style="max-width: 600px;margin: 0 auto;background: #fff;color: #444;font-size: 12px;font-family: Arial;line-height: 18px;"><div class="panel"><div class="panel-head" style="margin: 0 0 15px 0;padding: 35px 20px 10px 20px;border-bottom: 3px solid #00b7f1;"></div><div class="panel-body"><div class="welcome"><h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0"> Cảm ơn quý khách '.$param['fullname'].' đã đặt hàng tại '.$param['brandname'].',</h1><p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"> '.$param['brandname'].' rất vui thông báo đơn hàng #'.$param['payment_code'].' của quý khách đã được tiếp nhận và đang trong quá trình xử lý. '.$param['brandname'].' sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p></div><div class="infor"><div class="title"><h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin đơn hàng #'.$param['payment_code'].' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.gettime($param['payment_created'],'d/m/Y H:i:s').')</span></h3></div><table cellspacing="0" cellpadding="0" border="0" width="100%"><thead><tr><th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">Thông tin thanh toán</th><th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">Thông tin địa chỉ giao hàng</th></tr></thead><tbody><tr><td valign="top" style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><span style="text-transform:capitalize">Tên: '.$param['fullname'].'</span><br>Email: <a href="mailto:'.$param['email'].'" target="_blank">'.$param['email'].'</a><br>SĐT: '.$param['p_phone'].'</td><td valign="top" style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><span style="text-transform:capitalize">Tên: '.$param['fullname'].'</span><br> Email: <a href="mailto:'.$param['email'].'" target="_blank">'.$param['email'].'</a><br>Đc: '.$param['address'].'<br>SĐT: '.$param['p_phone'].'</td></tr><tr><td valign="top" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" colspan="2"><p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phương thức thanh toán: </strong>'.$param['payment'].'</p></td></tr></tbody></table><p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Với những đơn hàng thanh toán trả trước, xin vui lòng đảm bảo người nhận hàng đúng thông tin đã đăng ký trong đơn hàng, và chuẩn bị giấy tờ tùy thân để đơn vị giao nhận có thể xác thực thông tin khi giao hàng.</i></p></div><div class="detail"><h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2><table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5"><thead><tr> <th colspan="2" align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th><th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Đơn giá</th><th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th><th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Giảm giá</th><th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th></tr></thead><tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">'.$param['product'].'</tbody> <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"><tr><td colspan="5" align="right" style="padding:5px 9px">Tổng giá trị sản phẩm chưa giảm</td><td align="right" style="padding:5px 9px"><span>'.number_format($param['total_price']).'&nbsp;₫</span></td></tr><tr bgcolor="#eee"><td colspan="5" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong></td><td align="right" style="padding:7px 9px"><strong><big><span>'.number_format($param['total_price']).'&nbsp;₫</span></big></strong></td></tr><tr bgcolor="#eee"><td colspan="5" align="right" style="padding:7px 9px"><strong><big>Khuyến mại</big></strong></td><td align="right" style="padding:7px 9px"><strong><big><span>'.$param['discount_coupon'].'&nbsp;₫</span></big></strong></td></tr><tr bgcolor="#eee"><td colspan="5" align="right" style="padding:7px 9px"><strong><big>Tổng tiền cần thanh toán</big></strong></td><td align="right" style="padding:7px 9px"><strong><big><span>'.$param['total_price_coupon'].'&nbsp;₫</span></big></strong></td></tr></tfoot></table><p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Bạn cần được hỗ trợ ngay? Chỉ cần email <a href="mailto:'.$param['system_email'].'" style="color:#099202;text-decoration:none" target="_blank"><strong>'.$param['system_email'].'</strong></a>, hoặc gọi số điện thoại <strong style="color:#099202">'.$param['phone'].'</strong> (8-21h cả T7,CN). Đội ngũ '.$param['brandname'].' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p><p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa '.$param['brandname'].' cảm ơn quý khách.</p><p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a style="color:#00a3dd;text-decoration:none;font-size:14px" href="" target="_blank" >'.$param['brandname'].'</a></strong><br></p></div></div></div></div><div style="max-width: 600px;margin: 0 auto;"><p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 15px;margin:0px;font-weight:normal" align="left">Quý khách nhận được email này vì đã mua hàng tại '.$param['web'].'.<br>Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ '.$param['web'].', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$param['system_email'].'" target="_blank">'.$param['system_email'].'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email. <br><b>Văn phòng '.$param['web'].':</b> <a href="" target="_blank">'.$param['system_address'].'</a> </p></div>';
	}
}
if(!function_exists('mail_html_contact')){
	function mail_html_contact($param = NULL){
		$CI =& get_instance();
		return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><div id="ht-order-email" style="max-width: 600px;margin: 0 auto;background: #fff;color: #444;font-size: 12px;font-family: Arial;line-height: 18px;"><div class="panel"><div class="panel-head" style="margin: 0 0 15px 0;padding: 35px 20px 10px 20px;border-bottom: 3px solid #00b7f1;"><table width="100%" cellpadding="0" cellspacing="0"><tbody></tbody></table></div><div class="panel-body"><div class="infor"><div class="title"><h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;">Thông tin liên hệ</h3></div><table cellspacing="0" cellpadding="0" border="0" width="100%"><thead><tr></tr></thead><tbody><tr><td valign="top" style="padding:0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><span style="text-transform:capitalize">Họ và tên: '.$param['fullname'].'</span><br>Email: <a href="mailto:'.$param['email'].'" target="_blank">'.$param['email'].'</a><br>SĐT: '.$param['phone'].'<br>Nội dung: '.$param['message'].'<br>Trả lời: '.$param['reply'].'</td></tr></tbody></table></div><div class="detail"></div></div></div></div>';
	}
}




if(!function_exists('recovery_template')){
	function recovery_template($param = ''){
		$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<table class="body-wrap" style="width: 100%;margin: 0;padding: 0;box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;-o-box-sizing:border-box">
			<tr>
				<td style="vertical-align: top;"  style="vertical-align: top;"></td>
				<td style="vertical-align: top;"  class="container" width="600" style="vertical-align: top;">
					<div class="content">
						<table class="main" width="100%" style="background:#f6f6f6;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="vertical-align: top;padding: 20px"  class="content-wrap" >
									<table  cellpadding="0" cellspacing="0">
										<tr>
											<td style="vertical-align: top;padding: 0 0 20px;"  class="content-block">
												<h3 style="margin-top:10px !important;margin-top:10px;font-family:\'Segoe UI\';font-weight:500;text-transform:uppercase;">Xin chào '.$param['fullname'].',</h3>
											</td>
										</tr>
										<tr>
											<td style="vertical-align: top;padding:0 0 20px 0;font-family:\'Segoe UI\' !important;font-size:15px;line-height:168%;"  class="content-block">
												Chúng tôi nhận thấy bạn gặp sự cố khi đăng nhập tài khoản. Nếu bạn cần cài đặt lại mật khẩu của mình, hãy làm theo hướng bên dưới và chúng tôi sẽ giúp bạn đăng nhập.
											</td>
										</tr>
										<tr>
											<td style="vertical-align: top;padding:0 0 20px 0;font-family:\'Segoe UI\' !important;font-size:15px;line-height:168%;"  class="content-block"  class="content-block">
												Đã có hoạt động đăng nhập không thành công vào tài khoản của bạn. Sử dụng mã xác thực dưới đây để chắc chắn rằng là bạn đang thực hiện thao tác này.
											</td>
										</tr>
										<tr>
											<td style="vertical-align: top;"  class="content-block aligncenter">
												<a href="#" class="btn-primary" style="text-decoration: none;color: #FFF;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height:2;font-weight:500;font-family:\'Segoe UI\';text-align:center;display:inline-block;">'.((isset($param['otpCode'])) ? $param['otpCode'] : '').'</a>
											</td>
										</tr>
									  </table>
								</td>
							</tr>
						</table>
					
						</div>
				</td>
				<td style="vertical-align: top;"  style="vertical-align: top;" ></td>
			</tr>
		</table>';
		return $html;
	}
	
	
}

if(!function_exists('otp_render')){
	function otp_code_render($leng = 6){
		$s = '0123456789';
		mt_srand((double)microtime() * 1000000);
		$otp = '';
		for ($i=0; $i<$leng; $i++){
			$otp = $otp . substr($s, (mt_rand()%(strlen($s))), 1);
		}
		return $otp;
	}
}