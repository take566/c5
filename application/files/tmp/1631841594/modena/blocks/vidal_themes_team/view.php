<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<?php if (isset($chooseAnimation) && trim($chooseAnimation) != "" && array_key_exists($chooseAnimation, $chooseAnimation_options)) : ?>
    <?php $animation = "animated"." ".$chooseAnimation; ?>
<?php endif; ?>

<?php if (isset($animationOffset) && trim($animationOffset) != "") : ?>
    <?php $offset = "data-appear-top-offset='$animationOffset'"; ?>
<?php endif; ?>

<?php if (isset($animateOnce) && trim($animateOnce) != "") : ?>
    <?php $runOnce = ($animateOnce == 1 ? "animate-once" : ""); ?>
<?php endif; ?>

<div class="animated-parent <?php echo $buttonPosition." ".$runOnce; ?>" <?php echo $offset ?>>
    <div class="profile <?php echo $animation." ".$animationSpeed; ?>">
        <?php  if ($profileImage) : ?>
            <div class="profile__avatar <?php if (isset($roundProfilePic) && trim($roundProfilePic) != "" && array_key_exists($roundProfilePic, $roundProfilePic_options)) : ?><?php  echo $roundProfilePic; ?><?php endif; ?>">
                <img src="<?php  echo $profileImage->getURL(); ?>" alt="<?php  echo $profileImage->getTitle(); ?>"/>
            </div>
        <?php  endif; ?>
        <div class="profile__meta">
            <?php  if (isset($profileName) && trim($profileName) != "") : ?>
                <span class="profile__meta-name"><?php  echo h($profileName); ?></span>
                <span class="profile__divider">//</span>
            <?php endif; ?>
            <?php  if (isset($jobTitle) && trim($jobTitle) != "") : ?>
                <span class="profile__meta-position"><?php  echo h($jobTitle); ?></span>
            <?php endif; ?>
        </div>
        <?php  if (isset($profileBio) && trim($profileBio) != "") : ?>
            <div class="profile__bio">
                <?php echo $profileBio; ?>
            </div>
        <?php endif; ?>
    </div>
</div>