<?php $data = get_query_var( 'chart_data' ); $i = 0; ?>

<table bgcolor="black" width="305">
    <tr class="table-headers" bgcolor="grey" align="center">
        <th width="50">Rank</th>
        <th width="85">Name</th>
        <th width="85">Reach</th>
        <th width="85">Taggings</th>
    </tr>

    <?php foreach ($chart_data["tags"]["tag"] as $entry): $i++; ?>
        
    <tr class="song-<?php echo $i; ?>" bgcolor="lightgrey" align="center">
        <td><?php echo $i; ?></td>
        <td><?php echo $entry["name"]; ?></td>
        <td><?php echo number_format($entry["reach"]); ?></td>
        <td><?php echo number_format($entry["taggings"]); ?></td>
    </tr>

    <?php endforeach; ?>
</table>

