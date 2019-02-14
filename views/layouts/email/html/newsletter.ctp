<?php
	$site_url = Configure::read('site_url');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <body>
			<center>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" height="100%" style="background-color:#f5f7f7;font-family:Arial, Verdana, Tahoma !important;font-size:14px;color:#333333">
				<tbody>
				<tr>
					<td valign="top" align="center">
						<table width="802" cellspacing="0" cellpadding="10" border="0" style="background-color:#f5f7f7">
							<tbody>
								<tr>
									<td valign="top" align="center">
										<a href="<?php echo $site_url;?>/">
											<img src="<?php echo $site_url;?>/logo-newsletter.jpg">
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						<table width="802" cellspacing="0" cellpadding="1" bgcolor="#D0D0D0" style="background-color:#D0D0D0;border-radius:5px">
							<tbody>
								<tr>
									<td>
										<table width="800" cellspacing="0" cellpadding="0" style="background-color:#FFF;border-radius:5px">
											<tbody>
												<tr>
												<td valign="top" align="left" style="border-radius:5px">
													<table width="800" cellspacing="0" cellpadding="0" border="0" style="border-radius:5px">
														<tbody>
															<tr>
																<td valign="top" align="left" style="background-color:#FFFFFF;border-radius:5px" colspan="3">
																<table width="100%" cellspacing="0" cellpadding="20" border="0" style="border-radius:5px">
																	<tbody>
																		<tr>
																			<td valign="top" align="left" style="border-radius:5px">
																				<?php e($content_for_layout);?>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</tr>
														</tbody>
													</table>
												</td>
												<tr>
											</tbody>
										</table>
									</tr>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</center>
	</body>
</html>

