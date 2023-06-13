import logo from './logo.svg';
import './App.css';

/*WIP*/
function App() {
	function PuzzleButton(){
		return(
			<button onClick={handleStart} className="puzzle-bttn">
				New Puzzle
			</button>
		);
	};	
	function SetButton(){
		return(
			<button onClick={} className="diff-bttn">
				Difficulty
			</button>
		);
	};
	
	/*Un-altered JS*/
	const GRID_TEMP=[...Array(9)].map(()=> Array(9).fill(0)); /*ES6*/
	const cell={row:0,col:0,value:0};

	function genGrid(cell){
		let value=0;
		for(let i=0;i<81;i++){
			cell.row=findRow(i);
			cell.col=findCol(i);
			value=valueGen(cell);
			if(value){
				grid[cell.row][cell.col]=value;
			}
			else{
				i-=2;
			}
		}
	}

	function valueGen(cell){
		let $val_arr=[1,2,3,4,5,6,7,8,9];
		let $local_arr=grid[cell.row];
		
		for(let i=0;i<9;i++){
			$local_arr.push(grid[cell.row][i]);
		}
		
		blockTest(cell,$local_arr);
		let dupe=new Set($local_arr);
		dupe.delete(0);
		
		if(dupe.length){
			for(let i=0;i<dupe.length;i++){
				$var_arr.splice($var_arr.indexOf(dupe[1]),1);
			}	
		}
		if($var_arr.length){
			return $var_arr[Math.floor(Math.random()*$var_arr.length)];
		}
		return 0;
	}	
		
	/*Low-Level Functions*/
	function isSafe(cell){
		for(let i=0;i<9;i++){
			if(cell.grid[cell.row][i]===cell.value||cell.grid[i][cell.col]===cell.value){
				return false;
			}
		}
		return(blockTest(cell) ? true:false){
	}


	function blockTest(cell,$block_arr){	
		let row_start=Math.floor(cell.row/3)*3;
		let col_start=Math.floor(cell.col/3)*3;
		//Note:grid divided into 3x3 blocks
		
		for(let i=0;i<3;i++){
			$block_arr.push(
			grid[row_start+i][col_start],
			grid[row_start+i][col_start+1],
			grid[row_start+i][col_start+2]
			);
		}
	}

	//Find Functions  
	function findRow(pos){
		return Math.floor(pos/9);
	}

	function findColumn(pos){
		return pos%9;
	}	
  return (
	<div className="App">
		<header className="App-header">
			<h1>Sudoku App</h1>
		</header>
		<div className="main">
		<Grid/>
		
			<PuzzleButton/>
			<SetButton/>
		</div>
	</div>
  );
}
export default App;

