
export function randNumGen(row,col){
	var $rand_arr=[];
	let arr5=[];
	console.log(row);
	console.log(col);
	console.log(arr5);
	for(let p=0;p<9;p++){
		arr5[p]=answ_grid[p][col];
	}
	console.log(arr5);
	for(var z=1;z<10;z++){
		//console.log("z:"+z);
		if(answ_grid[row].indexOf(z)===-1&&arr5.indexOf(z)===-1){
			$rand_arr.push(z);
			console.log($rand_arr);
		}
	}		
	console.log($rand_arr);
	return $rand_arr[Math.floor(Math.random()*$rand_arr.length)];
}