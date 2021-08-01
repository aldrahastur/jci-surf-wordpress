<div
    class="cookie-preference border-top"
    aria-hidden="true"
    role="dialog"
    aria-describedby="CookiePrefDescription"
    aria-modal="true"
>
    <div class="container not-visible">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="row no-gutters align-items-top">
                    <?php if ($cookieBoxShowLogo) { ?>
                        <div class="col-12">
                            <img
                                class="cookie-logo"
                                src="<?php echo $cookieBoxLogo; ?>"
                                srcset="<?php echo implode(', ', $cookieBoxLogoSrcSet); ?>"
                                alt="<?php echo esc_attr($cookieBoxPreferenceTextHeadline); ?>"
                            >
                        </div>
                    <?php } ?>

                    <div class="<?php echo $cookieBoxShowLogo ? 'col-12' : 'col-12'; ?>">
                        <h3><?php echo $cookieBoxPreferenceTextHeadline; ?></h3>

                        <p id="CookiePrefDescription">
                            <?php echo $cookieBoxPreferenceTextDescription; ?>
                        </p>

                        <div class="row no-gutters align-items-center">
                            <div class="col-12">
                                <p class="_brlbs-accept">
                                    <?php if ($cookieBoxShowAcceptAllButton) { ?>
                                        <span
                                            class="_brlbs-btn _brlbs-btn-accept-all _brlbs-cursor"
                                            tabindex="0"
                                            role="button"
                                            data-cookie-accept-all
                                        >
                                            <?php echo $cookieBoxPreferenceTextAcceptAllButton; ?>
                                        </span>
                                    <?php } ?>

                                    <span
                                        id="CookiePrefSave"
                                        tabindex="0"
                                        role="button"
                                        class="_brlbs-btn _brlbs-cursor"
                                        data-cookie-accept
                                    >
                                        <?php echo $cookieBoxPreferenceTextSaveButton; ?>
                                    </span>
                                </p>
                            </div>

                            <div class="col-12">
                                <p class="_brlbs-refuse">
                                    <span
                                        class="_brlbs-cursor cookie-link"
                                        tabindex="0"
                                        role="button"
                                        data-cookie-back
                                    >
                                        <?php echo $cookieBoxPreferenceTextBackLink; ?>
                                    </span>

                                    <?php if ($cookieBoxHideRefuseOption === false) { ?>
                                        <span class="_brlbs-separator"></span>
                                        <span
                                            class="_brlbs-cursor"
                                            tabindex="0"
                                            role="button"
                                            data-cookie-refuse
                                        >
                                            <?php echo $cookieBoxPreferenceTextRefuseLink; ?>
                                        </span>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-cookie-accordion>
                    <?php if (!empty($cookieGroups)) { ?>
                        <?php foreach ($cookieGroups as $groupData) { ?>
                            <?php if (!empty($groupData->cookies)) { ?>
                                <div class="bcac-item">
                                    <div class="d-flex flex-row">
                                        <label for="borlabs-cookie-group-<?php echo $groupData->group_id; ?>" class="w-75">
                                            <span role="heading" aria-level="4" class="_brlbs-h4"><?php echo esc_html($groupData->name); ?> (<?php echo count($groupData->cookies); ?>)</span >
                                        </label>

                                        <div class="w-25 text-right">
                                            <?php if ($groupData->group_id !== 'essential') { ?>
                                                <label class="_brlbs-btn-switch">
                                                    <input
                                                        tabindex="0"
                                                        id="borlabs-cookie-group-<?php echo $groupData->group_id; ?>"
                                                        type="checkbox"
                                                        name="cookieGroup[]"
                                                        value="<?php echo $groupData->group_id; ?>"
                                                        <?php echo !empty($groupData->pre_selected) ? ' checked' : ''; ?>
                                                        data-borlabs-cookie-switch
                                                    />
                                                    <span class="_brlbs-slider"></span>
                                                    <span
                                                        class="_brlbs-btn-switch-status"
                                                        data-active="<?php echo $cookieBoxPreferenceTextSwitchStatusActive; ?>"
                                                        data-inactive="<?php echo $cookieBoxPreferenceTextSwitchStatusInactive; ?>">
                                                    </span>
                                                </label>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="d-block">
                                        <p><?php echo $groupData->description; ?></p>

                                        <p class="text-center">
                                            <span
                                                class="_brlbs-cursor d-block cookie-link"
                                                tabindex="0"
                                                role="button"
                                                data-cookie-accordion-target="<?php echo $groupData->group_id; ?>"
                                            >
                                                <span data-cookie-accordion-status="show">
                                                    <?php echo $cookieBoxPreferenceTextShowCookieLink; ?>
                                                </span>

                                                <span data-cookie-accordion-status="hide" class="borlabs-hide">
                                                    <?php echo $cookieBoxPreferenceTextHideCookieLink; ?>
                                                </span>
                                            </span>
                                        </p>
                                    </div>

                                    <div
                                        class="borlabs-hide"
                                        data-cookie-accordion-parent="<?php echo $groupData->group_id; ?>"
                                    >
                                        <?php foreach ($groupData->cookies as $cookieData) { ?>
                                            <table>
                                                <?php if ($groupData->group_id !== 'essential') { ?>
                                                    <tr hidden>
                                                        <th><?php echo $cookieBoxCookieDetailsTableAccept; ?></th>
                                                        <td>
                                                            <label class="_brlbs-btn-switch _brlbs-btn-switch--textRight">
                                                                <input
                                                                    id="borlabs-cookie-<?php echo $cookieData->cookie_id; ?>"
                                                                    tabindex="0"
                                                                    type="checkbox" data-cookie-group="<?php echo $groupData->group_id; ?>"
                                                                    name="cookies[<?php echo $groupData->group_id; ?>][]"
                                                                    value="<?php echo $cookieData->cookie_id; ?>"
                                                                    <?php echo !empty($groupData->pre_selected) ? ' checked' : ''; ?>
                                                                    data-borlabs-cookie-switch
                                                                />

                                                                <span class="_brlbs-slider"></span>

                                                                <span
                                                                    class="_brlbs-btn-switch-status"
                                                                    data-active="<?php echo $cookieBoxPreferenceTextSwitchStatusActive; ?>"
                                                                    data-inactive="<?php echo $cookieBoxPreferenceTextSwitchStatusInactive; ?>"
                                                                    aria-hidden="true">
                                                                </span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <th><?php echo $cookieBoxCookieDetailsTableName; ?></th>
                                                    <td>
                                                        <label for="borlabs-cookie-<?php echo $cookieData->cookie_id; ?>">
                                                            <?php echo esc_html($cookieData->name); ?>
                                                        </label>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th><?php echo $cookieBoxCookieDetailsTableProvider; ?></th>
                                                    <td><?php echo esc_html($cookieData->provider); ?></td>
                                                </tr>

                                                <?php if (!empty($cookieData->purpose)) { ?>
                                                    <tr>
                                                        <th><?php echo $cookieBoxCookieDetailsTablePurpose; ?></th>
                                                        <td><?php echo $cookieData->purpose; ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if (!empty($cookieData->privacy_policy_url)) { ?>
                                                    <tr>
                                                        <th><?php echo $cookieBoxCookieDetailsTablePrivacyPolicy; ?></th>
                                                        <td class="_brlbs-pp-url">
                                                            <a
                                                                href="<?php echo esc_url($cookieData->privacy_policy_url); ?>"
                                                                target="_blank"
                                                                rel="nofollow noopener noreferrer"
                                                            >
                                                                <?php echo esc_url($cookieData->privacy_policy_url); ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if (!empty($cookieData->hosts)) { ?>
                                                    <tr>
                                                        <th><?php echo $cookieBoxCookieDetailsTableHosts; ?></th>
                                                        <td><?php echo implode(', ', $cookieData->hosts); ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if (!empty($cookieData->cookie_name)) { ?>
                                                    <tr>
                                                        <th><?php echo $cookieBoxCookieDetailsTableCookieName; ?></th>
                                                        <td><?php echo esc_html($cookieData->cookie_name); ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if (!empty($cookieData->cookie_expiry)) { ?>
                                                    <tr>
                                                        <th><?php echo $cookieBoxCookieDetailsTableCookieExpiry; ?></th>
                                                        <td><?php echo esc_html($cookieData->cookie_expiry); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-between">
                    <p class="_brlbs-branding flex-fill">
                        <?php if ($supportBorlabsCookie) { ?>
                            <a
                                href="<?php echo esc_attr_x('https://borlabs.io/borlabs-cookie/', 'Frontend / Global / URL', 'borlabs-cookie'); ?>"
                                target="_blank"
                                rel="nofollow noopener noreferrer"
                            >
                                <img src="<?php echo $supportBorlabsCookieLogo; ?>" alt="Borlabs Cookie">
                                <?php echo ' ' ?>
                                <?php _ex('powered by Borlabs Cookie', 'Frontend / Global / Text', 'borlabs-cookie'); ?>
                            </a>
                        <?php } ?>
                    </p>

                    <p class="_brlbs-legal flex-fill">
                        <?php if (!empty($cookieBoxPrivacyLink)) { ?>
                            <a href="<?php echo $cookieBoxPrivacyLink; ?>">
                                <?php echo $cookieBoxTextPrivacyLink; ?>
                            </a>
                        <?php } ?>

                        <?php if (!empty($cookieBoxPrivacyLink) && !empty($cookieBoxImprintLink)) { ?>
                            <span class="_brlbs-separator"></span>
                        <?php } ?>

                        <?php if (!empty($cookieBoxImprintLink)) { ?>
                            <a href="<?php echo $cookieBoxImprintLink; ?>">
                                <?php echo $cookieBoxTextImprintLink; ?>
                            </a>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
