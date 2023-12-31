<?php

use Duplicator\Controllers\StoragePageController;
use Duplicator\Core\CapMng;
use Duplicator\Models\Storages\AbstractStorageEntity;
use Duplicator\Models\Storages\StoragesUtil;

defined("ABSPATH") or die("");

$global       = DUP_PRO_Global_Entity::getInstance();
$storage_list = AbstractStorageEntity::getAll(0, 0, [StoragesUtil::class, 'sortByPriority']);

$langLocalDefaultMsg = __('Recovery Point Capable', 'duplicator-pro');
$ui_css_storage      = (DUP_PRO_UI_ViewState::getValue('dup-pack-storage-panel') ? 'display:block' : 'display:none');
?>
<style>
    /*STORAGE: Area*/
    div.storage-filters {display:inline-block; padding: 0 10px 0 10px}
    tr.storage-missing td, tr.storage-missing td a {color: #A62426 !important }
</style>

<!-- ===================
META-BOX: STORAGE -->
<div class="dup-box" id="dup-pack-storage-panel-area">
    <div class="dup-box-title" id="dpro-store-title">
        <i class="fas fa-server fa-sm"></i> <?php DUP_PRO_U::esc_html_e('Storage') ?> <sup id="dpro-storage-title-count" class="dup-box-title-badge"></sup>
        <button class="dup-box-arrow">
            <span class="screen-reader-text"><?php DUP_PRO_U::esc_html_e('Toggle panel:') ?> <?php DUP_PRO_U::esc_html_e('Storage Options') ?></span>
        </button>
    </div>          

    <div class="dup-box-panel" id="dup-pack-storage-panel" style="<?php echo esc_attr($ui_css_storage); ?>">
        <div style="padding:0 0 4px 0">
            <?php DUP_PRO_U::esc_html_e('Choose the storage location(s) where the archive and installer files will be saved.') ?>
        </div>
        <table class="widefat pack-store-tbl">
        <thead>
            <tr>
                <th style='white-space: nowrap; width:10px;'></th>
                <th style='width:175px'><?php DUP_PRO_U::esc_html_e('Type') ?></th>
                <th style='width:275px'><?php DUP_PRO_U::esc_html_e('Name') ?></th>
                <th style="white-space: nowrap"><?php DUP_PRO_U::esc_html_e('Location') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i                  = 0;
        $selectedStorageIds = $global->getManualModeStorageIds();
        foreach ($storage_list as $storage) {
            try {
                if (!$storage->isSupported()) {
                    continue;
                }

                $i++;
                $is_valid       = $storage->isValid();
                $is_checked     = in_array($storage->getId(), $selectedStorageIds) && $is_valid;
                $mincheck       = ($i == 1) ? 'data-parsley-mincheck="1" data-parsley-required="true"' : '';
                $row_style      = ($i % 2) ? 'alternate' : '';
                $row_style     .= ($is_valid) ? '' : ' storage-missing';
                $row_chkid      = "dup-chkbox-{$storage->getId()}";
                $storageEditUrl = StoragePageController::getEditUrl($storage);
                ?>
                <tr class="package-row <?php echo esc_attr($row_style); ?>">
                    <td>
                        <input name="edit_id" type="hidden" value="<?php echo intval($i); ?>" />
                        <input 
                            class="duppro-storage-input" 
                            id="<?php echo $row_chkid; ?>"
                            name="_storage_ids[]"
                            onclick="DupPro.Pack.UpdateStorageCount(); return true;"
                            data-parsley-errors-container="#storage_error_container" <?php echo $mincheck; ?>
                            type="checkbox"
                            value="<?php echo $storage->getId(); ?>"
                            <?php disabled($is_valid == false); ?>
                            <?php checked($is_checked); ?> 
                        >
                    </td>
                    <td>
                        <label for="<?php echo $row_chkid; ?>" class="dup-store-lbl">
                        <?php
                            echo $storage->getStypeIcon() . '&nbsp;' . esc_html($storage->getStypeName());
                            echo ($storage->isLocal())
                                ? "<sup title='{$langLocalDefaultMsg}'><i class='fas fa-undo-alt fa-fw fa-sm'></i></sup>"
                                : '';
                        ?>
                        </label>
                    </td>
                    <td>
                        <a href="<?php echo $storageEditUrl; ?>" target="_blank">
                            <?php
                                echo ($is_valid == false)  ? '<i class="fa fa-exclamation-triangle fa-sm"></i> '  : '';
                                echo esc_html($storage->getName());
                            ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $storage->getHtmlLocationLink();?>
                    </td>
                </tr>
                <?php
            } catch (Exception $e) {
                echo "<tr><td colspan='5'><i>"
                . DUP_PRO_U::__('Unable to load storage type.  Please validate the setup.')
                . "</i></td></tr>";
            }
        }
        ?>
        </tbody>
        </table>
        <div style="text-align: right; margin:4px 4px -4px 0; padding:0; width: 100%">
            <?php if (CapMng::can(CapMng::CAP_STORAGE, false)) { ?>
                <a href="admin.php?page=duplicator-pro-storage&tab=storage&inner_page=edit" target="_blank">
                    [<?php DUP_PRO_U::esc_html_e('Add Storage') ?>]
                </a>
            <?php } else { ?>
                &nbsp;
            <?php } ?>
        </div>
    </div>
</div>

<div id="storage_error_container" class="duplicator-error-container"></div>

<script>
    jQuery(function ($)
    {
        DupPro.Pack.UpdateStorageCount = function ()
        {
            var store_count = $('#dup-pack-storage-panel input[name="_storage_ids[]"]:checked').length;
            $('#dpro-storage-title-count').html('(' + store_count + ')');
            (store_count == 0)
                    ? $('#dpro-storage-title-count').css({'color': 'red', 'font-weight': 'bold'})
                    : $('#dpro-storage-title-count').css({'color': '#444', 'font-weight': 'normal'});
        }
    });

//INIT
    jQuery(document).ready(function ($)
    {
        DupPro.Pack.UpdateStorageCount();
    });
</script>
