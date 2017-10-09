<?php

if ( $timeline ) {
	echo "<li>
	    <time class='cbp_tmtime' datetime='2017-10-09T03:45'><span>" . \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->format('H:i A') . "</span> <span>" . \Carbon\Carbon::createFromFormat( 'd/m/Y', $notification->created_at->format( 'd/m/Y' ) )->diffForHumans() . "</span></time>
	    <div class='cbp_tmicon timeline-bg-" . ( isset( $type ) ? $type : '' ) . "'>
	        <i class='fa-".( isset( $icon ) ? $icon : '' )."'></i>
	    </div>
	    <div class='cbp_tmlabel'>
	        <h2>
	            <a href='" . ( isset( $link ) ? $link : '' ) . "'>".( isset( $prefix ) ? $prefix : '' ) . "</a> <span>".( isset( $message ) ? $message : '' )."</span>
	        </h2>
	        <p>" . ( isset( $content ) ? $content : '' ) . "</p>
	    </div>
	</li>";
} else {
	echo "
	<li class='notification-" . ( isset( $type ) ? $type : '' ) . "'> 
		<a href='" . ( isset( $link ) ? $link : '' ) . "'> 
			<i class='fa-" . ( isset( $icon ) ? $icon : '' ) . "'></i> 
			<span class='line'>" . ( $notification->read_at ? '' : '<strong>' ) . ( isset( $prefix ) ? $prefix : '' ) . " " . ( isset( $message ) ? $message : '' ) . ( $notification->read_at ? '' : '</strong>' ) . "</span> 
			<span class='line small time'>" . \Carbon\Carbon::createFromFormat( 'd/m/Y', $notification->created_at->format( 'd/m/Y' ) )->diffForHumans() . "</span> 
		</a> 
	</li>
	";
}