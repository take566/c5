<?php
defined('C5_EXECUTE') or die("Access Denied.");

if (!$previousLinkURL && !$nextLinkURL && !$parentLabel) {
    return false;
}
?>

<div class="grid-row margin-top-30">

    <div class="column-12">
        <div class="next-previous--divider"></div>
    </div>

    <div class="column-4">
        <?php if ($previousLinkText) : ?>
            <p>
                <i class="icon ion-ios-arrow-back">&nbsp;</i><?php echo $previousLinkURL ? '<a href="' . $previousLinkURL . '">' . $previousLinkText . '</a>' : '' ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="column-4 text-center">
        <?php if ($parentLabel) : ?>
            <p class="next-previous--label">
                <?php echo $parentLinkURL ? '<a href="' . $parentLinkURL . '">' . $parentLabel . '</a>' : '' ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="column-4 text-right">
        <?php if ($nextLinkText) : ?>
            <p class="ccm-block-next-previous-next-link">
                <?php echo $nextLinkURL ? '<a href="' . $nextLinkURL . '">' . $nextLinkText . '</a>' : '' ?>&nbsp;<i class="icon ion-ios-arrow-forward"></i>
            </p>
        <?php endif; ?>
    </div>
</div>
