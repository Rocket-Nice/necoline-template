<?php $ports = get_posts([
	'post_type'   => 'schedule-1',
	'posts_per_page'   => -1,
]);
?>
<?php foreach ($ports as $port) : ?>
	<?php
	$shipName = get_field('schedule_1_ship', $port->ID);
	$shipID = $shipName->ID; // Получаем ID корабля
	$isActive = get_field('fickle-is-active', $shipID);
	$current_date = date('d.m');
	$current_year = date('Y');
	$current_time = strtotime($current_date . '.' . $current_year);

	$skip_port = true;
	$skipDate = false;

	$portsName = get_field('ports_repeat', $port->ID);

	if (!empty($portsName) && is_array($portsName)) {
		foreach ($portsName as $portName) {
			$port_infos = $portName['ports_group']['port_info'];

			if (!empty($port_infos) && is_array($port_infos)) {
				$skip_group = true;
				foreach ($port_infos as $port_info) {
					$etd_date = strtotime($port_info['date_etd'] . '.' . $current_year);
					if ($etd_date < $current_time) {
						$skipDate = true;
					}
				}

				foreach ($port_infos as $port_info) {
					// Проверяем, содержит ли строка дату валидный формат
					if (strpos($port_info['date_etd'], '.') !== false) {
						// Преобразуем строку в дату
						$etd_date = strtotime($port_info['date_etd'] . '.' . $current_year);
						// Продолжаем только если дата была успешно преобразована
						if ($etd_date !== false) {
							// Проверяем условие, если дата отправления больше или равна текущей дате
							if ($etd_date >= $current_time) {
								// Устанавливаем флаг пропуска в false
								$skip_group = false;
							}
						}
					}
				}

				if (!$skip_group) {
					$skip_port = false;
				}
			}
		}
	}

	if ($skip_port || $isActive) {
		continue;
	}
	?>
	<section class="vessel-information">
		<div class="vessel-information__title title title--h2"><?php echo $shipName->post_title; ?>
			<a href="<?php the_permalink($shipName->ID) ?>" class="title"><?php esc_html_e('Подробнее о судне', 'necoline'); ?></a>
		</div>
		<div class="vessel-information__table-and-track">
			<div class="vessel-information__table-wrapper">
				<table class="vessel-information__table table">
					<thead class="table__thead title">
						<tr>
							<?php $portsName = get_field('ports_repeat', $port->ID);
							$portsCount = count($portsName);
							$i = 0;
							?>
							<th>Voyage</th>
							<?php foreach ($portsName as $portName) : ?>
								<?php if ($i === 0) : ?>
									<th colspan="2"><?php echo $portName['ports_group']['port_name']->post_title; ?></th>
									<th>Voyage</th>
								<?php else : ?>
									<th colspan="3"><?php echo $portName['ports_group']['port_name']->post_title; ?></th>
								<?php endif; ?>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tr>
					</thead>

					<tbody class="table__tbody">
						<tr class="title">
							<td></td>
							<?php $i = 1; ?>
							<?php foreach ($portsName as $portName) : ?>
								<?php if ($i === 1) : ?>

									<td colspan="2">Etd</td>
									<td></td>
								<?php elseif ($i < $portsCount) : ?>
									<td>Cut Off</td>
									<td>Eta</td>
									<td>Etd</td>
								<?php else : ?>
									<td colspan="2">Cut Off</td>
									<td colspan="2">Eta</td>
							<?php endif;
								$i++;
							endforeach;
							?>
						</tr>
						<?php $ports_info = $portName['ports_group']['port_info']; ?>
						<?php $idx = 0; ?>
						<?php foreach ($ports_info as $port_info) : ?>
							<tr>
								<td><?php echo $port_info['number-1']; ?></td>

								<?php $i = 1 ?>
								<?php foreach ($portsName as $portName) : ?>
									<?php $ports_info = $portName['ports_group']['port_info'][$idx]; ?>
									<?php if ($i === 1) : ?>

										<td colspan="2"><?php echo $ports_info['date_etd']; ?></td>

										<td><?php echo $port_info['number-2']; ?></td>
									<?php elseif ($i < $portsCount) : ?>
										<td><?php echo $ports_info['date_cut_off']; ?></td>
										<td><?php echo $ports_info['date_eta']; ?></td>
										<td><?php echo $ports_info['date_etd']; ?></td>
									<?php else : ?>
										<td colspan="2"><?php echo $ports_info['date_cut_off']; ?></td>
										<td colspan="2"><?php echo $ports_info['date_eta']; ?></td>
									<?php endif; ?>
									<?php $i++ ?>
								<?php endforeach; ?>
							</tr>
							<?php $idx++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- <div class="vessel-information__track">
					<a href="#" class="vessel-information__track-head">
<div class="vessel-information__track-dot"></div>
<div class="vessel-information__track-text title">Отследить судно online</div>
</a>
					<div class="vessel-information__track-card card card--primary">
						<picture>
							<img class="vessel-information__track-image" src="<?php the_field('ship_img_left', $shipName->ID) ?>" alt="" data-pagespeed-url-hash="3682093504" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" data-pagespeed-lsc-url="<?php the_field('ship_img_left', $shipName->ID) ?>">
						</picture>
						<a href="<?php the_permalink($shipName->ID) ?>" class="vessel-information__track-link title"><?php esc_html_e('Подробнее о судне', 'necoline'); ?></a>
					</div>
				</div> -->
		</div>
	</section>
<?php endforeach ?>