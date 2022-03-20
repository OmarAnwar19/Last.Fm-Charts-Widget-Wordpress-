<?php $data = get_query_var( 'chart_data' ); $i = 0; ?>

<table bgcolor="black" width="305">
    <tr class="table-headers" bgcolor="grey" align="center">
        <th width="50">Rank</th>
        <th width="65">Cover</th>
        <th width="90">Song</th>
        <th width="90">Artist</th>
    </tr>

    <?php foreach ($chart_data["tracks"]["track"] as $entry): $i++; ?>
        
    <tr class="song-<?php echo $i; ?>" bgcolor="lightgrey" align="center">
        <td><?php echo $i; ?></td>
        <td><img src='<?php echo $entry["image"][0]["#text"]; ?>' alt="image" /></td>
        <td><?php echo $entry["name"]; ?></td>
        <td><?php echo $entry["artist"]["name"]; ?></td>
    </tr>

    <?php endforeach; ?>
</table>

