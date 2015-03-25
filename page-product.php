<?php /* Template Name: Product */ ?>
<?php get_header(); ?>

<div id="subhead_container">

    <div class="row">

        <div class="twelve columns">

            <h1><?php the_title(); ?></h1>

        </div>	

    </div>
</div>

<!--content-->
<div class="row" id="content_container">

    <!--left col-->
    <div class="twelve columns">

        <div id="left-col">

            <?php if (have_posts()) while (have_posts()) : the_post(); ?>

                    <div class="post-entry">
                        <h3>Imagen</h3>
                        <?php the_post_thumbnail('medium'); ?>
                        <div class="clear"></div>
                        <h3>Precio</h3>
                        <?php echo get_post_meta(get_the_ID(), '_product_price', true); ?> 
                        <br/>
                        <h3>Descripcion</h3>
                        <?php echo get_post_meta(get_the_ID(), '_product_description', true); ?> 
                        <br/>

                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs-1">Detalles del producto</a></li>
                                <li><a href="#tabs-2">Detalles del producto</a></li>
                            </ul>
                            <div id="tabs-1" class="wp-editor-container">
                                <p><?php echo get_post_meta(get_the_ID(), '_product_detail', true); ?> </p>
                            </div>  
                            <div id="tabs-2">       
                                <table>
                                    <tbody>
                                        <?php
                                        $product_detail_table_key = get_post_meta(get_the_ID(), '_product_detail_table_key', true);
                                        $product_detail_table_value = get_post_meta(get_the_ID(), '_product_detail_table_value', true);
                                        $product_detail_table_select = get_post_meta(get_the_ID(), '_product_detail_table_select', true);
                                        $product_detail_table_select2 = get_post_meta(get_the_ID(), '_product_detail_table_select2', true);

                                        foreach ($product_detail_table_key as $a => $b) {
                                            ?>
                                            <tr>
                                        <p>
                                        <td>
            <?php echo $a + 1; ?>
                                        </td>
                                        <td>
                                            <label>Key</label>
                                            <input type="text" readonly="readonly" name="product_detail_table_key[$a]" value="<?php echo $product_detail_table_key[$a]; ?>">
                                        </td>
                                        <td>
                                            <label for="product_detail_table_value">Value</label>
                                            <input type="text" readonly="readonly" class="small"  name="product_detail_table_value[]" value="<?php echo $product_detail_table_value[$a]; ?>">
                                        </td>
                                        <td>
                                            <label for="product_detail_table_select">Select</label>
                                            <input type="text" readonly="readonly" name="product_detail_table_select[]" value="<?php echo $product_detail_table_select[$a]; ?>">
                                        </td>
                                        <td>
                                            <label for="product_detail_table_select2">Select2</label>
                                            <input type="text" readonly="readonly" name="product_detail_table_select2[]" value="<?php echo $product_detail_table_select2[$a]; ?>">
                                        </td>
                                        </p>
                                        </tr>
        <?php } ?>                                         
                                    </tbody>
                                </table>
                            </div> 
                        </div>
        <?php wp_link_pages(array('before' => '' . __('Pages:', 'discover'), 'after' => '')); ?>

                    </div><!--post-entry end-->

        <?php comments_template('', true) ?>; 



    <?php endwhile; ?>

        </div> <!--left-col end-->
    </div> <!--column end-->
</div>
<!--content end-->


<?php get_footer(); ?>