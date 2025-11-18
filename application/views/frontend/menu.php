<div class="menu" style="text-align: right;">
    <ul>
        <li>
            <a href="<?php echo site_url(); ?>">Beranda</a>
        </li>
        <?php
        // menu dari halaman
        if(menu_halaman_frontend()): ?>
        <?php foreach(menu_halaman_frontend() as $halaman_row): ?>
            <li>
                <a href="<?php echo site_url('halaman/detail/'.$halaman_row->halaman_id); ?>">
                    <?php echo $halaman_row->judul; ?>
                </a>
            </li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>