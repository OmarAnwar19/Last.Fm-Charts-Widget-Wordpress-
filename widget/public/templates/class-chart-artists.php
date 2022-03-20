<?php $data = get_query_var( 'chart_data' ); $i = 0; ?>

<table bgcolor="black" width="305">
    <tr class="table-headers" bgcolor="grey" align="center">
        <th width="50">Rank</th>
        <th width="65">Image</th>
        <th width="90">Name</th>
        <th width="90">Playcount</th>
    </tr>

    <?php foreach ($chart_data["artists"]["artist"] as $entry): $i++; ?>
        
    <tr class="artist-<?php echo $i; ?>" bgcolor="lightgrey" align="center">
        <td><?php echo $i; ?></td>
        <td><img src='<?php echo $entry["image"][0]["#text"]; ?>' alt="image" /></td>
        <td><?php echo $entry["name"]; ?></td>
        <td><?php echo number_format($entry["playcount"]); ?></td>
    </tr>

    <?php endforeach; ?>
</table>

