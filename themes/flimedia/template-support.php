<?php
/*
Template Name: Support Page Template
*/
get_header(); ?>

<div class="tab-block">
       
    <?php
    // Ensure the fields exist before rendering
    if (have_rows('tabs_repeater')) : ?>
        <div class="tabs">
            <ul class="tab-labels">
                <?php
                $tab_index = 0;
                while (have_rows('tabs_repeater')) : the_row();
                    $tab_label = get_sub_field('tab_label');
                    ?>
                    <li class="tab-link uppercase <?php echo $tab_index === 0 ? 'tab-active' : ''; ?>" data-tab="tab-<?php echo $tab_index; ?>">
                        <?php echo esc_html($tab_label); ?>
                    </li>
                    <?php
                    $tab_index++;
                endwhile;
                ?>
            </ul>

            <?php
            // Reset the loop for the tab content
            $tab_index = 0;
            reset_rows();
            while (have_rows('tabs_repeater')) : the_row(); ?>
                <div id="tab-<?php echo $tab_index; ?>" class="tab-content <?php echo $tab_index === 0 ? 'tab-active' : ''; ?>">
                    <div class="row card-wrapper">
                        <?php
                        // Cards Repeater
                        if (have_rows('tab_cards_repeater')) :
                            while (have_rows('tab_cards_repeater')) : the_row();
                                $tab_card_title = get_sub_field('tab_card_title');
                                $tab_card_text = get_sub_field('tab_card_text');
				            	$tab_card_link = get_sub_field( 'tab_card_link' );
                                ?>
                                <div class="columns small-12 medium-6 large-4 card">
                                    <div class="card-content round">
                                        <h3><?php echo esc_html($tab_card_title); ?></h3>
                                        <p><?php echo esc_html($tab_card_text); ?></p>
                                        <?php if( $tab_card_link ): 
                                            $link_url = $tab_card_link['url'];
                                            $link_title = $tab_card_link['title'];
                                            $link_target = $tab_card_link['target'] ? $tab_card_link['target'] : '_self';
                                            ?>
                                                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
                <?php
                $tab_index++;
            endwhile;
            ?>
        </div>
    <?php endif; ?>

</div>

<?php get_template_part( 'template-parts/cta-with-icon-btn' ); ?>


<script>
        document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('tab-active'));
            tabContents.forEach(content => content.classList.remove('tab-active'));
            this.classList.add('tab-active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('tab-active');
            });
        });
        });
    </script>

<?php get_footer(); ?>
