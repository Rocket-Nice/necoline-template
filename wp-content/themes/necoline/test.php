<?php $args = array(
    'post_type'      => 'schedule-1',
    'post_status'    => 'publish',
    'posts_per_page' => - 1,
    ); 
    
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
        $post_object = get_field('schedule_1_ship');
        $rays_repeat = get_field('ports_repeat');
        print_r($rays_repeat)
    ?>
            <section class="vessel-information">
              <div class="container">
                <div class="vessel-information__title title title--h2"><?php echo $post_object->post_title; ?></div>
                <div class="vessel-information__table-and-track">
                  <div class="vessel-information__table-wrapper">
                    <table class="vessel-information__table table">
                      <thead class="table__thead title">
                          <tr>
                      <?php if( have_rows('ports_repeat') ):
                            while ( have_rows('ports_repeat') ) : the_row(); ?>
                            <!-- <th width="130"></th> -->
                            <th colspan="2"><?php $rays_repeat->post_title; ?></th>
                      <?php endwhile;
                            endif;
                      ?>
                          </tr>
                      </thead>
                        
                      <tbody class="table__tbody">
                        <tr class="title">
                          <?php if( have_rows('ports_repeat') ):
                            while ( have_rows('ports_repeat') ) : the_row(); ?>
                            <?php print_r( the_sub_field('ports_repeat',32) ); ?>
                            <td>Etd</td>
                            <td>Eta</td>
                          <?php endwhile;
                                endif;
                          ?>
                        </tr>
                        <tr>
                          <td>147HR EXP</td>
                          <td>16.06</td>
                          <td>148HR IMP</td>
                          <td>21.06</td>
                          <td>22.06</td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                  <div class="vessel-information__track">
                    <a href="#" class="vessel-information__track-head">
                      <div class="vessel-information__track-dot"></div>
                      <div class="vessel-information__track-text title">Отследить судно online</div>
                    </a>
                    <div class="vessel-information__track-card card card--primary">
                      <picture>
                        <source type="image/webp" srcset="<?php theme_image('vessel-information-track-bg.webp'); ?>" />
                        <img class="vessel-information__track-image" src="<?php theme_image('vessel-information-track-bg.png'); ?>" alt="Судно" />
                      </picture>
                      <a href="#" class="vessel-information__track-link title">Подробнее о судне</a>
                    </div>
                  </div>
                </div>
              </div>
          </section>
    <?php
        endwhile;
    endif;

    wp_reset_postdata();
    
    ?>








<?php //var_dump($portsName) ?>
<?php $idx = 1; ?>
<?php foreach ($portsName as $portName) : ?>
<?php if ($idx === 1) : ?>
<td colspan="2"><?php echo $port_info['date_etd']; ?></td>
<?php elseif ($idx < $portsCount) : ?>
<td><?php echo $port_info['date_etd']; ?></td>
<td><?php echo $port_info['date_eta']; ?></td>
<?php else : ?>
<td colspan="2"><?php echo $port_info['date_eta']; ?>  <?php echo $idx; ?></td>
<?php endif; ?>
<?php $idx++; ?>
<?php endforeach; ?>