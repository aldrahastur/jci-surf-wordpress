<?php

namespace WJD\Calendar;


class CalendarExtension
{
    public function __construct()
    {
        add_action('wp_ajax_get_listing_calendar', array($this, 'getListingCalendarAction'));
        add_action('wp_ajax_nopriv_get_listing_calendar', array($this, 'getListingCalendarAction'));

        add_action('wp_ajax_get_all_events', array($this, 'getAllEventsAction'));
        add_action('wp_ajax_nopriv_get_all_events', array($this, 'getAllEventsAction'));

        add_filter('mc_event_content', array($this, 'mc_event_detail_override'),10,4);
    }

    public function getListingCalendarAction()
    {
        global $wpdb;
        $dbPrefix = $wpdb->prefix;
        $vars = filter_input(INPUT_GET, 'vars', FILTER_DEFAULT);
        if ($vars) {
            $vars = str_replace(array('{','}','"'),'',$vars);
            $vars = explode(',',$vars);
            $parsed = [];
            foreach ($vars as $var) {
                $parsed[explode(':',$var)[0]] = explode(':',$var)[1];
            }
            $date = new \DateTime($parsed['year'].'-'.$parsed['month'].'-'.$parsed['day']);
        } else {
            $date = new \DateTime();
        }
        $curWeekStart = $date->modify('this week')->format('Y-m-d H:i:s');
        $curWeekEnd = $date->modify('this week +6 days')->format('Y-m-d H:i:s');
        $result = array();
        $resultOcc = $wpdb->get_results(
            'SELECT * FROM `'.$dbPrefix.'my_calendar_events`
            WHERE ( "'.$curWeekEnd.'" >= `occur_begin`) AND ("'.$curWeekStart.'" <= `occur_end`)
            GROUP BY `occur_event_id`
            ORDER BY `occur_begin` ASC'
        );
        foreach ($resultOcc as $occ) {
            $fullOcc = $wpdb->get_results(
                'SELECT * FROM `'.$dbPrefix.'my_calendar`
                WHERE `event_id` = '.$occ->occur_event_id
            )[0];
            $fullOcc->event_link = get_permalink(get_option('mc_uri_id')).'?mc_id='.$occ->occur_id;
            $fullOcc->event_begin = substr($occ->occur_begin,0,10);
            $fullOcc->event_end = substr($occ->occur_end,0,10);
            $fullOcc->event_time = substr($occ->occur_begin,11,18);
            $fullOcc->event_endtime = substr($occ->occur_end,11,18);
            array_push($result, $fullOcc);
        }
        echo json_encode($result);
        wp_die();
    }

    public function getAllEventsAction() {
        global $wpdb;
        $dbPrefix = $wpdb->prefix;
        $date = new \DateTime();
        $future = array();
        $past = array();
        $futureOccurences = $wpdb->get_results(
            'SELECT * FROM `'.$dbPrefix.'my_calendar_events` 
            WHERE `occur_begin` > "'.$date->format('Y-m-d H:i:s').'"
            GROUP BY `occur_event_id`
            ORDER BY `occur_begin` ASC'
        );
        foreach ($futureOccurences as $focc) {
            $fullFOcc = $wpdb->get_results(
                'SELECT * FROM `'.$dbPrefix.'my_calendar`
                WHERE `event_id` = '.$focc->occur_event_id
            )[0];
            $fullFOcc->event_link = get_permalink(get_option('mc_uri_id')).'?mc_id='.$focc->occur_id;
            $fullFOcc->event_begin = substr($focc->occur_begin,0,10);
            $fullFOcc->event_end = substr($focc->occur_end,0,10);
            $fullFOcc->event_time = substr($focc->occur_begin,11,18);
            $fullFOcc->event_endtime = substr($focc->occur_end,11,18);
            array_push($future, $fullFOcc);
        }
        $result['future'] = $future;
        $pastOccurences = $wpdb->get_results(
            'SELECT * FROM `'.$dbPrefix.'my_calendar_events` 
            WHERE `occur_end` < "'.$date->format('Y-m-d H:i:s').'"
            GROUP BY `occur_event_id`
            ORDER BY `occur_begin` ASC'
        );
        foreach ($pastOccurences as $pocc) {
            $fullPOcc = $wpdb->get_results(
                'SELECT * FROM `'.$dbPrefix.'my_calendar`
                WHERE `event_id` = '.$pocc->occur_event_id
            )[0];
            $fullPOcc->event_link = get_permalink(get_option('mc_uri_id')).'?mc_id='.$pocc->occur_id;
            $fullPOcc->event_begin = substr($pocc->occur_begin,0,10);
            $fullPOcc->event_end = substr($pocc->occur_end,0,10);
            $fullPOcc->event_time = substr($pocc->occur_begin,11,18);
            $fullPOcc->event_endtime = substr($pocc->occur_end,11,18);
            array_push($past, $fullPOcc);
        }
        $result['past'] = $past;
        echo json_encode($result);
        wp_die();
    }

    public function mc_event_detail_override($details, $event, $type, $time) {
        ob_start();?>
        <div class="headline-section">
            <div class="headline-section__content text-center container">
                <h2 class="headline-section__headline is-highlighted"><?=$event->event_title?></h2>
            </div>
            <div class="section">
                <div class="section__content container text-left">
                    <div class="rte-content">
                        <p><?=$event->event_desc?></p>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="section__content container text-left">
                    <div class="card  has-image has-no-footer">
                        <?php if (strlen($event->event_image) > 0): ?>
                            <div class="card__image-wrapper">
                                <figure class="figure">
                                    <div class="figure__image-wrapper is-highlighted">
                                        <div class="figure__image">
                                            <img src="<?=$event->event_image?>" alt="">
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        <?php endif; ?>
                        <div class="card__content">
                            <ul class="card__meta-data no-list-style">
                                <li class="card__meta-data-item is-text">
                                    Event
                                </li>
                            </ul>
                            <div class="card__main">
                                <div class="card__event-data has-location">
                                    <div class="row">
                                        <div class="col-2 card__tag card__event-label">
                                            Datum:
                                        </div>
                                        <div class="col-10">
                                            <div class="card__event-date">
                                                <ul class="event-date  no-list-style">
                                                    <?php if ($event->event_begin === $event->event_end && $event->event_time === '00:00:00' && $event->event_endtime === '23:59:59'): ?>
                                                        <li class="event-date__item">
                                                            <span class="event-date__date"><?=$event->event_begin?></span> Ganztags
                                                        </li>
                                                    <?php else: ?>
                                                    <li class="event-date__item">
                                                        <span class="event-date__date"><?=$event->event_begin?></span>
                                                        <span class="event-date__time"><?=$event->event_time?> Uhr</span>
                                                    </li>
                                                    <li class="event-date__item">
                                                        <span class="event-date__date"><?=$event->event_end?></span>
                                                        <span class="event-date__time"><?=$event->event_endtime?> Uhr</span>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                                            
                                    <?php if(strlen($event->event_label) > 0):?>
                                        <div class="row">
                                            <div class="col-2 card__tag card__event-label">
                                                Ort:
                                            </div>
                                            <div class="col-10">
                                                <div class="card__event-location">
                                                    <p class="address" translate="no"><span class="organization"><?=$event->event_label?></span><br>
                                                        <span class="address-line1"><?=$event->event_street?></span><br>
                                                        <span class="postal-code"><?=$event->event_postcode?></span> <span class="locality"><?=$event->event_city?></span><br>
                                                        <span class="country"><?=$event->event_country?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        return ob_get_clean();
    }
}