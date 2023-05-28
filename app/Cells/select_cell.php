                  <div class="col-md-4">
                    <label for="input<?= $name ?>"><?= $text ?></label>
                  </div>
                  <div class="col-md-8 form-group">
                    <fieldset class="form-group">
                      <select class="form-select" id="input<?= $name ?>" name="<?= $name ?>">
                        <?php foreach ($option as $item) : ?>
                          <option><?= $item ?></option>
                        <?php endforeach; ?>
                      </select>
                    </fieldset>
                  </div>