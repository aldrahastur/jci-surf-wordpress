<div
    id="BorlabsCookieBox"
    class="BorlabsCookie custom-cookie-box"
    role="dialog"
    aria-labelledby="CookieBoxTextHeadline"
    aria-describedby="CookieBoxTextDescription"
    aria-modal="true"
>
    <div class="<?php echo $cookieBoxPosition; ?>" style="display: none;">
        <div class="_brlbs-bar-wrap">
            <div class="_brlbs-bar _brlbs-bar-advanced">
                <div class="cookie-box">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 text-center">
                                <div class="row">
                                    <?php if ($cookieBoxShowLogo) { ?>
                                        <div class="col-12 text-center _brlbs-no-padding-right">
                                            <img
                                                class="cookie-logo"
                                                src="<?php echo $cookieBoxLogo; ?>"
                                                srcset="<?php echo implode(', ', $cookieBoxLogoSrcSet); ?>"
                                                alt="<?php echo esc_attr($cookieBoxTextHeadline); ?>"
                                                aria-hidden="true"
                                                style="min-height: 200px; width: 400px"
                                            >
                                        </div>
                                    <?php } ?>

                                    <div class="<?php echo $cookieBoxShowLogo ? 'col-12' : 'col-12'; ?>">
                                        <h3 id="CookieBoxTextHeadline" class="h2">
                                            <?php echo $cookieBoxTextHeadline; ?>
                                        </h3>
                                        <p id="CookieBoxTextDescription">
                                            <?php echo $cookieBoxTextDescription; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <?php if ($cookieBoxShowAcceptAllButton) { ?>
                                    <p class="_brlbs-accept">
                                        <a
                                            href="#"
                                            tabindex="0"
                                            role="button"
                                            class="_brlbs-btn _brlbs-btn-accept-all _brlbs-cursor"
                                            data-cookie-accept-all
                                        >
                                            <?php echo $cookieBoxPreferenceTextAcceptAllButton; ?>
                                        </a>
                                    </p>

                                    <p class="_brlbs-accept">
                                        <a
                                            href="#"
                                            tabindex="0"
                                            role="button"
                                            id="CookieBoxSaveButton"
                                            class="_brlbs-btn _brlbs-cursor"
                                            data-cookie-accept
                                        >
                                            <?php echo $cookieBoxPreferenceTextSaveButton; ?>
                                        </a>
                                    </p>
                                <?php } else { ?>
                                    <p class="_brlbs-accept">
                                        <a
                                            href="#"
                                            tabindex="0"
                                            role="button"
                                            id="CookieBoxSaveButton"
                                            class="_brlbs-btn<?php echo $cookieBoxShowAcceptAllButton ? ' _brlbs-btn-accept-all' : ''; ?> _brlbs-cursor"
                                            data-cookie-accept
                                        >
                                            <?php echo $cookieBoxTextAcceptButton; ?>
                                        </a>
                                    </p>
                                <?php } ?>

                                <?php if ($cookieBoxHideRefuseOption === false) { ?>
                                    <p class="<?php echo $cookieBoxRefuseOptionType === 'link' ? '_brlbs-refuse' : '_brlbs-refuse-btn'; ?>">
                                        <a
                                            href="#"
                                            tabindex="0"
                                            role="button"
                                            class="<?php echo $cookieBoxRefuseOptionType === 'button' ? '_brlbs-btn ' : ''; ?>_brlbs-cursor"
                                            data-cookie-refuse
                                        >
                                            <?php echo $cookieBoxTextRefuseLink; ?>
                                        </a>
                                    </p>
                                <?php } ?>

                                <p class="_brlbs-manage">
                                    <a
                                        href="#"
                                        tabindex="0"
                                        role="button"
                                        class="_brlbs-cursor"
                                        data-cookie-individual
                                    >
                                        <?php echo $cookieBoxTextManageLink; ?>
                                    </a>
                                </p>

                                <p class="_brlbs-legal">
                                    <a
                                        href="#"
                                        tabindex="0"
                                        role="button"
                                        class="_brlbs-cursor"
                                        data-cookie-individual
                                    >
                                        <?php echo $cookieBoxTextCookieDetailsLink; ?>
                                    </a>

                                    <?php if (!empty($cookieBoxPrivacyLink)) { ?>
                                        <span class="_brlbs-separator"></span>
                                        <a
                                            tabindex="0"
                                            href="<?php echo $cookieBoxPrivacyLink; ?>"
                                        >
                                            <?php echo $cookieBoxTextPrivacyLink; ?>
                                        </a>
                                    <?php } ?>

                                    <?php if (!empty($cookieBoxImprintLink)) { ?>
                                        <span class="_brlbs-separator"></span>
                                        <a
                                            tabindex="0"
                                            href="<?php echo $cookieBoxImprintLink; ?>"
                                        >
                                            <?php echo $cookieBoxTextImprintLink; ?>
                                        </a>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($cookiePreferenceTemplateFile)) {
                    include $cookiePreferenceTemplateFile;
                } ?>
            </div>
        </div>
    </div>
</div>
