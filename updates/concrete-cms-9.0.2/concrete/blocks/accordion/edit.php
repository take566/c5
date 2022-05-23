<?php defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Application\Service\UserInterface;
use Concrete\Core\Support\Facade\Application;

$app = Application::getFacadeApplication();

/** @var UserInterface $userInterface */
$userInterface = $app->make(UserInterface::class);

echo $userInterface->tabs([
    ['accordion-content', t('Content'), true],
    ['accordion-settings', t('Settings')],
]);
?>

<div class="tab-content">

  <div class="tab-pane show active" id="accordion-content" role="tabpanel">

    <div data-vue="accordion-block">

      <input type="hidden" name="accordionBlockData" :value="JSON.stringify(entries)" />

      <div class="p-2 btn-toolbar border-primary mb-2 border" role="toolbar">
          <button type="button" class="btn-sm btn btn-secondary" @click="addEntry"><i class="fas fa-plus-circle"></i> <?=t('Add Entry')?></button>
      </div>

      <draggable class="image-container" v-model="entries">
          <div v-for="(entry, index) in entries" :class="{'position-relative': true, 'p-2': true, 'm-2': true, 'bg-light': true, 'bg-opacity-50': !entry.expanded}">
              <div class="btn-group" style="position: absolute; top: 0; right: 0">
                  <a href="javascript:void(0)" v-if="entry.expanded" class="d-flex align-items-center btn btn-secondary btn-sm" @click="entry.expanded = false"><i class="fas fa-compress-alt"></i></a>
                  <a href="javascript:void(0)" v-if="!entry.expanded" class="d-flex align-items-center btn btn-secondary btn-sm" @click="entry.expanded = true"><i class="fas fa-expand-alt"></i></a>
                  <a href="javascript:void(0)" @click="deleteEntry(index)" class="d-flex align-items-center btn btn-secondary btn-sm"><i class="fas fa-times"></i></a>
              </div>
              <div v-if="entry.expanded">
                  <div class="mb-3">
                      <label class="form-label"><?=t('Title')?></label>
                      <input type="text" autocomplete="off" class="form-control" v-model="entry.title" />
                  </div>
                  <div>
                      <label class="form-label"><?=t('Body')?></label>
                      <ckeditor v-model="entry.description"></ckeditor>
                  </div>
              </div>
              <div v-else>
                  <a href="javascript:void(0)" style="cursor: move" class="d-block">{{entry.title}}</a>
              </div>
          </div>
      </draggable>

    </div>

  </div>

  <div class="tab-pane" id="accordion-settings" role="tabpanel">

    <fieldset>

  		<div class="form-group">
  			<?php echo $form->label('initialState', t('Initial State'))?>
  		  <?php echo $form->select('initialState', array('openfirst' => t('First Item Open'),'closed' => t('All Items Closed'),'open' => t('All Items Open')), $initialState); ?>
  	  </div>

  	  <div class="form-group">
  			<?php echo $form->label('itemHeadingFormat', t('Item Heading Format'))?>
  		  <?php echo $form->select('itemHeadingFormat', \Concrete\Core\Block\BlockController::$btTitleFormats, $itemHeadingFormat); ?>
  	  </div>

      <div class="form-group">

        <?php echo $form->label('options', t('Options'))?>

        <div class="form-check">
            <?php echo $form->checkbox("alwaysOpen", "1", $alwaysOpen);?>
            <?php echo $form->label("alwaysOpen", t("Always Open (make accordion items stay open when another item is opened)"), ["class" => "form-check-label"]); ?>
        </div>

        <div class="form-check">
            <?php echo $form->checkbox("flush", "1", $flush);?>
            <?php echo $form->label("flush", t("Flush (render accordion edge-to-edge)"), ["class" => "form-check-label"]); ?>
        </div>
      </div>

    </fieldset>

  </div>

</div>

<script>
    $(function() {
        Concrete.Vue.activateContext('accordion', function (Vue, config) {
            Vue.use(config.components.CKEditor) // I don't understand why this is required :(
            new Vue({
                el: 'div[data-vue=accordion-block]',
                components: config.components,
                data: {
                    entries: <?=json_encode($entries)?>
                },
                methods: {
                    addEntry() {
                        this.entries.push({
                            title: '',
                            description: '',
                            expanded: true
                        })
                    },
                    deleteEntry(index) {
                        this.entries.splice(index, 1)
                    }
                }
            })
        })
    })
</script>
